import { useState } from "react"
import { Link, NavLink } from "react-router-dom"
import matroLogo from "../assets/matro-logo.svg"
import useLanguage from "../hooks/useLanguage"

export default function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false)
  const { language, toggleLanguage, t } = useLanguage()

  const links = [
    { to: "/about", label: t("navAbout") },
    { to: "/products", label: t("navProducts") },
    { to: "/contact", label: t("navContact") },
  ]

  const navClass = ({ isActive }) =>
    `rounded-full px-4 py-2 text-sm font-semibold transition ${
      isActive ? "bg-[#173f35] text-white" : "text-[#36544a] hover:bg-[#e8eadb] hover:text-[#173f35]"
    }`

  return (
    <header className="sticky top-0 z-40 border-b border-[#173f35]/10 bg-[#f6f2e8]/95 backdrop-blur-xl">
      <div className="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <Link to="/" className="flex items-center" aria-label="Matro – úvodní stránka" onClick={() => setMenuOpen(false)}>
          <img src={matroLogo} alt="Matro s.r.o." className="h-9 w-auto sm:h-10" />
        </Link>

        <nav className="hidden items-center gap-1 md:flex" aria-label="Hlavní navigace">
          {links.map((link) => (
            <NavLink key={link.to} to={link.to} className={navClass}>
              {link.label}
            </NavLink>
          ))}
        </nav>

        <div className="flex items-center gap-2">
          <button
            type="button"
            onClick={toggleLanguage}
            className="rounded-full border border-[#173f35]/15 bg-white/70 px-3.5 py-2 text-xs font-black uppercase tracking-[0.14em] text-[#173f35] transition hover:border-[#173f35]/35 hover:bg-white"
            aria-label={t("switchLanguage")}
          >
            {language === "cs" ? "EN" : "CZ"}
          </button>
          <button
            type="button"
            className="grid h-10 w-10 place-items-center rounded-full border border-[#173f35]/15 text-lg text-[#173f35] md:hidden"
            onClick={() => setMenuOpen((open) => !open)}
            aria-expanded={menuOpen}
            aria-label={menuOpen ? t("closeMenu") : t("openMenu")}
          >
            <span aria-hidden="true">{menuOpen ? "×" : "≡"}</span>
          </button>
        </div>
      </div>

      {menuOpen && (
        <nav className="border-t border-[#173f35]/10 px-4 py-4 md:hidden" aria-label="Mobilní navigace">
          <div className="mx-auto flex max-w-7xl flex-col gap-1">
            {links.map((link) => (
              <NavLink
                key={link.to}
                to={link.to}
                className={navClass}
                onClick={() => setMenuOpen(false)}
              >
                {link.label}
              </NavLink>
            ))}
          </div>
        </nav>
      )}
    </header>
  )
}
