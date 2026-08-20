import { Link } from "react-router-dom"
import useLanguage from "../hooks/useLanguage"

const formatCurrency = (value, language) =>
  new Intl.NumberFormat(language === "cs" ? "cs-CZ" : "en-GB", {
    style: "currency",
    currency: "CZK",
    maximumFractionDigits: 2,
  }).format(value)

export default function ProductCard({ product, onOpen }) {
  const { categoryLabel, language, productName, t } = useLanguage()
  const priceWithVat = product.priceExVat * (1 + product.vatRate / 100)

  return (
    <article className="group flex h-full flex-col overflow-hidden rounded-[1.75rem] border border-[#173f35]/10 bg-white shadow-[0_24px_55px_-45px_rgba(23,63,53,0.65)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_60px_-38px_rgba(23,63,53,0.55)]">
      <button
        type="button"
        className="relative aspect-[4/3] overflow-hidden bg-[#e9ecd8] text-left"
        onClick={() => onOpen(product)}
        aria-label={`${t("quickView")}: ${productName(product)}`}
      >
        <img
          src={product.image}
          alt={productName(product)}
          className="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]"
          loading="lazy"
        />
        <span className="absolute left-4 top-4 rounded-full bg-[#f6f2e8]/92 px-3 py-1.5 text-[11px] font-black uppercase tracking-[0.12em] text-[#173f35] backdrop-blur">
          {product.brand}
        </span>
        <span className="absolute bottom-4 right-4 grid h-10 w-10 place-items-center rounded-full bg-[#173f35] text-lg text-white shadow-lg transition group-hover:rotate-12" aria-hidden="true">↗</span>
      </button>

      <div className="flex flex-1 flex-col p-5 sm:p-6">
        <p className="text-xs font-bold uppercase tracking-[0.14em] text-[#a45d3d]">{categoryLabel(product.category)}</p>
        <h3 className="mt-2 min-h-12 text-xl font-semibold leading-6 tracking-[-0.02em] text-[#173f35]">
          {productName(product)}
        </h3>

        <div className="mt-5 grid grid-cols-2 gap-3 border-y border-[#173f35]/8 py-4">
          <div>
            <span className="block text-[11px] font-bold uppercase tracking-[0.12em] text-[#78877f]">{t("excludingVat")}</span>
            <strong className="mt-1 block text-lg text-[#173f35]">{formatCurrency(product.priceExVat, language)}</strong>
          </div>
          <div className="border-l border-[#173f35]/10 pl-3">
            <span className="block text-[11px] font-bold uppercase tracking-[0.12em] text-[#78877f]">{t("includingVat")}</span>
            <strong className="mt-1 block text-lg text-[#173f35]">{formatCurrency(priceWithVat, language)}</strong>
          </div>
        </div>

        <div className="mt-4 flex items-center justify-between gap-3 text-xs text-[#61736a]">
          <span>{t("minOrder")}: <strong className="text-[#173f35]">{product.minOrder} {t("pieces")}</strong></span>
          <span>{t("package")}: <strong className="text-[#173f35]">{product.package}</strong></span>
        </div>

        <Link
          to={`/product/${product.slug}`}
          className="mt-5 inline-flex items-center justify-between rounded-full bg-[#edf1df] px-4 py-3 text-sm font-bold text-[#173f35] transition hover:bg-[#dce9b6]"
        >
          {t("detail")} <span aria-hidden="true">→</span>
        </Link>
      </div>
    </article>
  )
}
