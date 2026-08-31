(() => {
  const root = document.documentElement
  const storageKey = "matro-language"
  const getLanguage = () => (root.dataset.lang === "en" ? "en" : "cs")

  const setLanguage = (language) => {
    const next = language === "en" ? "en" : "cs"
    root.dataset.lang = next
    root.lang = next

    try {
      window.localStorage.setItem(storageKey, next)
    } catch {
      // Language remains active for the current page when storage is unavailable.
    }

    document.querySelectorAll("[data-language-code]").forEach((element) => {
      element.textContent = next === "cs" ? "EN" : "CZ"
    })
    document.querySelectorAll("[data-language-toggle]").forEach((button) => {
      button.setAttribute("aria-label", next === "cs" ? "Switch to English" : "Přepnout do češtiny")
    })
    document.querySelectorAll("[data-placeholder-cs]").forEach((input) => {
      input.placeholder = input.dataset[`placeholder${next === "cs" ? "Cs" : "En"}`] || ""
    })
    document.querySelectorAll("option[data-label-cs]").forEach((option) => {
      option.textContent = option.dataset[`label${next === "cs" ? "Cs" : "En"}`] || option.textContent
    })
    document.querySelectorAll("[data-aria-cs]").forEach((element) => {
      element.setAttribute("aria-label", element.dataset[`aria${next === "cs" ? "Cs" : "En"}`] || "")
    })
    document.dispatchEvent(new CustomEvent("matro:language", { detail: { language: next } }))
  }

  document.querySelectorAll("[data-language-toggle]").forEach((button) => {
    button.addEventListener("click", () => setLanguage(getLanguage() === "cs" ? "en" : "cs"))
  })
  setLanguage(getLanguage())

  const menuButton = document.querySelector("[data-menu-toggle]")
  const mobileMenu = document.querySelector("[data-mobile-menu]")
  if (menuButton && mobileMenu) {
    const closeMenu = () => {
      menuButton.setAttribute("aria-expanded", "false")
      mobileMenu.hidden = true
    }
    menuButton.addEventListener("click", () => {
      const willOpen = menuButton.getAttribute("aria-expanded") !== "true"
      menuButton.setAttribute("aria-expanded", String(willOpen))
      mobileMenu.hidden = !willOpen
    })
    mobileMenu.querySelectorAll("a").forEach((link) => link.addEventListener("click", closeMenu))
    window.addEventListener("resize", () => {
      if (window.innerWidth >= 768) closeMenu()
    })
  }

  document.querySelectorAll("[data-catalog]").forEach((catalog) => {
    const grid = catalog.querySelector("[data-product-grid]")
    const cards = grid ? Array.from(grid.querySelectorAll("[data-product-card]")) : []
    const initialOrder = new Map(cards.map((card, index) => [card, index]))
    const search = catalog.querySelector("[data-catalog-search]")
    const sort = catalog.querySelector("[data-catalog-sort]")
    const clear = catalog.querySelector("[data-clear-filters]")
    const empty = catalog.querySelector("[data-catalog-empty]")
    const categoryButtons = Array.from(catalog.querySelectorAll("[data-category-filter]"))
    const selected = new Set()

    const normalize = (value) => value.trim().toLocaleLowerCase(getLanguage() === "cs" ? "cs" : "en")

    const update = () => {
      const query = search ? normalize(search.value) : ""
      let visible = cards.filter((card) => {
        const categories = (card.dataset.categories || "").split(",").filter(Boolean)
        const categoryMatch = selected.size === 0 || categories.some((category) => selected.has(category))
        const searchMatch = !query || normalize(card.dataset.search || "").includes(query)
        const show = categoryMatch && searchMatch
        card.hidden = !show
        return show
      })

      const mode = sort ? sort.value : "relevance"
      visible = [...visible].sort((a, b) => {
        if (mode === "price-asc") return Number(a.dataset.price) - Number(b.dataset.price)
        if (mode === "price-desc") return Number(b.dataset.price) - Number(a.dataset.price)
        if (mode === "name") {
          const key = getLanguage() === "cs" ? "nameCs" : "nameEn"
          return (a.dataset[key] || "").localeCompare(b.dataset[key] || "", getLanguage())
        }
        return initialOrder.get(a) - initialOrder.get(b)
      })
      visible.forEach((card) => grid.appendChild(card))
      if (empty) empty.hidden = visible.length !== 0
      if (clear) clear.hidden = selected.size === 0
    }

    search?.addEventListener("input", update)
    sort?.addEventListener("change", update)
    categoryButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const category = button.dataset.categoryFilter
        if (selected.has(category)) selected.delete(category)
        else selected.add(category)
        button.setAttribute("aria-pressed", String(selected.has(category)))
        update()
      })
    })
    clear?.addEventListener("click", () => {
      selected.clear()
      categoryButtons.forEach((button) => button.setAttribute("aria-pressed", "false"))
      update()
    })
    document.addEventListener("matro:language", update)
    update()
  })

  const modal = document.querySelector("[data-product-modal]")
  if (modal) {
    const modalContent = modal.querySelector("[data-modal-content]")
    const modalTitle = modal.querySelector("[data-modal-title]")
    let activeTemplate = null
    let previousFocus = null

    const updateModalTitle = () => {
      if (!activeTemplate || !modalTitle) return
      const quickProduct = activeTemplate.content.querySelector(".quick-product")
      modalTitle.textContent = quickProduct?.dataset[getLanguage() === "cs" ? "titleCs" : "titleEn"] || ""
    }

    const closeModal = () => {
      modal.hidden = true
      document.body.classList.remove("modal-open")
      modalContent.replaceChildren()
      activeTemplate = null
      previousFocus?.focus()
    }

    document.querySelectorAll("[data-modal-open]").forEach((button) => {
      button.addEventListener("click", () => {
        const template = document.getElementById(button.dataset.modalOpen)
        if (!(template instanceof HTMLTemplateElement)) return
        activeTemplate = template
        previousFocus = button
        modalContent.replaceChildren(template.content.cloneNode(true))
        updateModalTitle()
        modal.hidden = false
        document.body.classList.add("modal-open")
        modal.querySelector("[data-modal-close]")?.focus()
      })
    })
    modal.querySelectorAll("[data-modal-close]").forEach((button) => button.addEventListener("click", closeModal))
    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && !modal.hidden) closeModal()
    })
    document.addEventListener("matro:language", updateModalTitle)
  }

  const backToTop = document.querySelector("[data-back-to-top]")
  if (backToTop) {
    const updateBackToTop = () => backToTop.classList.toggle("is-visible", window.scrollY > 500)
    window.addEventListener("scroll", updateBackToTop, { passive: true })
    backToTop.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }))
    updateBackToTop()
  }
})()
