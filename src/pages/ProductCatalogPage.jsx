import { useMemo, useState } from "react"
import { Link } from "react-router-dom"
import { PRODUCTS, CATEGORIES } from "../data/products"
import ProductCard from "../components/ProductCard"
import Filters from "../components/Filters"
import Modal from "../components/Modal"
import PageIntro from "../components/PageIntro"
import useLanguage from "../hooks/useLanguage"

const formatCurrency = (value, language) =>
  new Intl.NumberFormat(language === "cs" ? "cs-CZ" : "en-GB", {
    style: "currency",
    currency: "CZK",
    maximumFractionDigits: 2,
  }).format(value)

export default function ProductCatalogPage() {
  const [query, setQuery] = useState("")
  const [selectedCats, setSelectedCats] = useState([])
  const [sortBy, setSortBy] = useState("relevance")
  const [active, setActive] = useState(null)
  const { categoryLabel, language, productDescription, productName, tagLabel, t } = useLanguage()

  const filtered = useMemo(() => {
    const normalizedQuery = query.trim().toLocaleLowerCase(language === "cs" ? "cs" : "en")
    let items = PRODUCTS.filter((product) => {
      const searchable = [
        product.name,
        product.nameEn,
        product.description,
        product.descriptionEn,
        product.brand,
        product.sku,
        product.category,
        ...product.tags,
      ].join(" ").toLocaleLowerCase(language === "cs" ? "cs" : "en")

      return searchable.includes(normalizedQuery)
    })

    if (selectedCats.length) {
      items = items.filter((product) => selectedCats.includes(product.category))
    }

    items = [...items]
    switch (sortBy) {
      case "price-asc":
        items.sort((a, b) => a.priceExVat - b.priceExVat)
        break
      case "price-desc":
        items.sort((a, b) => b.priceExVat - a.priceExVat)
        break
      case "name-asc":
        items.sort((a, b) => productName(a).localeCompare(productName(b), language === "cs" ? "cs" : "en"))
        break
      default:
        if (normalizedQuery) {
          items.sort((a, b) => {
            const aStarts = productName(a).toLocaleLowerCase().startsWith(normalizedQuery) ? 1 : 0
            const bStarts = productName(b).toLocaleLowerCase().startsWith(normalizedQuery) ? 1 : 0
            return bStarts - aStarts
          })
        }
    }

    return items
  }, [language, productName, query, selectedCats, sortBy])

  const benefits = [
    [t("benefitsBio"), t("benefitsBioText")],
    [t("benefitsPrice"), t("benefitsPriceText")],
    [t("benefitsCare"), t("benefitsCareText")],
  ]

  return (
    <div className="bg-[#f6f2e8] text-[#18392f]">
      <main className="px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div className="mx-auto max-w-7xl">
          <PageIntro
            eyebrow={t("heroEyebrow")}
            title={t("heroTitle")}
            lead={t("heroText")}
          />

          <section className="grid gap-px overflow-hidden rounded-[1.75rem] bg-[#173f35]/10 my-6 sm:grid-cols-3 sm:my-8">
            {benefits.map(([title, description]) => (
              <div key={title} className="bg-[#fbf9f3] p-6 sm:p-7">
                <h2 className="text-lg font-semibold text-[#173f35]">{title}</h2>
                <p className="mt-2 text-sm leading-6 text-[#60736c]">{description}</p>
              </div>
            ))}
          </section>

          <section id="katalog" className="scroll-mt-28 pt-12 sm:pt-16">
          <div className="mb-8 max-w-2xl">
            <p className="text-xs font-bold uppercase tracking-[0.2em] text-[#aa6442]">{t("assortmentEyebrow")}</p>
            <h2 className="mt-3 font-serif text-4xl tracking-[-0.03em] text-[#173f35] sm:text-5xl">
              {t("assortmentTitle")}
            </h2>
            <p className="mt-4 text-sm leading-6 text-[#60736c] sm:text-base">{t("assortmentText")}</p>
          </div>

          <Filters
            query={query}
            setQuery={setQuery}
            categories={CATEGORIES}
            selectedCats={selectedCats}
            setSelectedCats={setSelectedCats}
            sortBy={sortBy}
            setSortBy={setSortBy}
          />

          <div className="mt-7 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {filtered.map((product) => (
              <ProductCard key={product.id} product={product} onOpen={setActive} />
            ))}
            {filtered.length === 0 && (
              <div className="col-span-full rounded-[1.75rem] border border-dashed border-[#173f35]/20 bg-white/50 py-16 text-center text-[#60736c]">
                {t("noProducts")}
              </div>
            )}
          </div>
          </section>

          <section className="my-16 overflow-hidden rounded-[2rem] bg-[#dce9b6] px-6 py-10 sm:px-10 lg:flex lg:items-center lg:justify-between lg:gap-10 lg:px-14">
            <div className="max-w-2xl">
              <p className="text-xs font-black uppercase tracking-[0.2em] text-[#8e5136]">MATRO B2B</p>
              <h2 className="mt-3 font-serif text-4xl tracking-[-0.03em] text-[#173f35]">{t("catalogCtaTitle")}</h2>
              <p className="mt-4 leading-7 text-[#4b665b]">{t("catalogCtaText")}</p>
            </div>
            <Link
              to="/contact"
              className="mt-7 inline-flex shrink-0 items-center justify-center rounded-full bg-[#173f35] px-6 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-[#285b4c] lg:mt-0"
            >
              {t("contactMatro")} <span className="ml-2" aria-hidden="true">→</span>
            </Link>
          </section>
        </div>
      </main>

      <Modal open={Boolean(active)} onClose={() => setActive(null)} title={active ? productName(active) : ""}>
        {active && (
          <div className="grid gap-6 md:grid-cols-[0.9fr_1.1fr]">
            <img src={active.image} alt={productName(active)} className="aspect-square w-full rounded-[1.5rem] object-cover" />
            <div className="flex flex-col">
              <p className="text-xs font-black uppercase tracking-[0.16em] text-[#a45d3d]">{categoryLabel(active.category)}</p>
              <p className="mt-4 leading-7 text-[#526b60]">{productDescription(active)}</p>
              <div className="mt-5 flex flex-wrap gap-2">
                {active.tags.map((tag) => (
                  <span key={tag} className="rounded-full bg-[#e8eadb] px-3 py-1.5 text-xs font-semibold text-[#36544a]">
                    {tagLabel(tag)}
                  </span>
                ))}
              </div>
              <dl className="mt-6 grid grid-cols-2 gap-3 rounded-[1.25rem] bg-white p-4 text-sm">
                <div>
                  <dt className="text-xs text-[#7b8982]">{t("excludingVat")}</dt>
                  <dd className="mt-1 font-bold text-[#173f35]">{formatCurrency(active.priceExVat, language)}</dd>
                </div>
                <div>
                  <dt className="text-xs text-[#7b8982]">{t("includingVat")}</dt>
                  <dd className="mt-1 font-bold text-[#173f35]">{formatCurrency(active.priceExVat * (1 + active.vatRate / 100), language)}</dd>
                </div>
                <div>
                  <dt className="text-xs text-[#7b8982]">{t("package")}</dt>
                  <dd className="mt-1 font-bold text-[#173f35]">{active.package}</dd>
                </div>
                <div>
                  <dt className="text-xs text-[#7b8982]">{t("minOrder")}</dt>
                  <dd className="mt-1 font-bold text-[#173f35]">{active.minOrder} {t("pieces")}</dd>
                </div>
              </dl>
              <Link
                to={`/product/${active.slug}`}
                className="mt-5 inline-flex items-center justify-between rounded-full bg-[#173f35] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#285b4c]"
                onClick={() => setActive(null)}
              >
                {t("detail")} <span aria-hidden="true">→</span>
              </Link>
            </div>
          </div>
        )}
      </Modal>
    </div>
  )
}
