import { Link } from "react-router-dom"
import matroLogo from "../assets/matro-logo.svg"
import useLanguage from "../hooks/useLanguage"

export default function Footer() {
  const { t } = useLanguage()

  return (
    <footer className="bg-[#102d25] px-4 py-10 text-white sm:px-6 lg:px-8">
      <div className="mx-auto max-w-7xl">
        <div className="grid gap-10 border-b border-white/12 pb-10 sm:grid-cols-2 lg:grid-cols-[1.5fr_0.7fr_0.9fr]">
          <div>
            <div className="inline-flex rounded-xl bg-[#f6f2e8] px-4 py-3">
              <img src={matroLogo} alt="Matro s.r.o." className="h-9 w-auto" />
            </div>
            <p className="mt-5 max-w-sm text-sm leading-6 text-white/65">{t("footerTagline")}</p>
          </div>

          <div>
            <h2 className="text-xs font-black uppercase tracking-[0.18em] text-[#dce9b6]">{t("footerNavigation")}</h2>
            <nav className="mt-5 flex flex-col items-start gap-3 text-sm text-white/75">
              <Link to="/about" className="transition hover:text-white">{t("navAbout")}</Link>
              <Link to="/products" className="transition hover:text-white">{t("navProducts")}</Link>
              <Link to="/contact" className="transition hover:text-white">{t("navContact")}</Link>
            </nav>
          </div>

          <div>
            <h2 className="text-xs font-black uppercase tracking-[0.18em] text-[#dce9b6]">{t("footerContact")}</h2>
            <div className="mt-5 space-y-3 text-sm text-white/75">
              <p>{t("placeholderPhone")}</p>
              <p>{t("placeholderEmail")}</p>
              <p>{t("placeholderAddress")}</p>
            </div>
          </div>
        </div>

        <div className="flex flex-col gap-3 pt-6 text-xs text-white/45 sm:flex-row sm:items-center sm:justify-between">
          <p>© {new Date().getFullYear()} MATRO Praha, s.r.o. · {t("footerRights")}</p>
          <p>{t("sampleData")}</p>
        </div>
      </div>
    </footer>
  )
}
