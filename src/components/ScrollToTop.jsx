import { useEffect, useLayoutEffect, useState } from "react"
import { useLocation } from "react-router-dom"
import useLanguage from "../hooks/useLanguage"

export default function ScrollToTop() {
  const { pathname } = useLocation()
  const [visible, setVisible] = useState(false)
  const { t } = useLanguage()

  useLayoutEffect(() => {
    window.scrollTo({ top: 0, left: 0, behavior: "auto" })
  }, [pathname])

  useEffect(() => {
    const updateVisibility = () => setVisible(window.scrollY > 500)

    updateVisibility()
    window.addEventListener("scroll", updateVisibility, { passive: true })
    return () => window.removeEventListener("scroll", updateVisibility)
  }, [])

  if (!visible) return null

  return (
    <button
      type="button"
      onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })}
      className="fixed bottom-5 right-5 z-30 grid h-12 w-12 place-items-center rounded-full border border-white/20 bg-[#173f35] text-xl text-white shadow-[0_14px_35px_-12px_rgba(23,63,53,0.8)] transition hover:-translate-y-1 hover:bg-[#285b4c] focus-visible:-translate-y-1 sm:bottom-7 sm:right-7"
      aria-label={t("backToTop")}
      title={t("backToTop")}
    >
      <span aria-hidden="true">↑</span>
    </button>
  )
}
