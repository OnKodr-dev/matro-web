import { Link, useParams } from "react-router-dom"
import { PRODUCTS } from "../data/products"
import useLanguage from "../hooks/useLanguage"

const formatCurrency = (value, language) =>
  new Intl.NumberFormat(language === "cs" ? "cs-CZ" : "en-GB", {
    style: "currency",
    currency: "CZK",
    maximumFractionDigits: 2,
  }).format(value)

export default function ProductDetailPage() {
  const { slug } = useParams()
  const product = PRODUCTS.find((item) => item.slug === slug)
  const { categoryLabel, language, productDescription, productName, tagLabel, t } = useLanguage()

  if (!product) {
    return (
      <main className="grid min-h-[65vh] place-items-center bg-[#f6f2e8] px-4 text-[#173f35]">
        <div className="max-w-xl text-center">
          <p className="text-xs font-black uppercase tracking-[0.2em] text-[#a45d3d]">404</p>
          <h1 className="mt-3 font-serif text-5xl">{t("productNotFound")}</h1>
          <p className="mt-4 text-[#60736c]">{t("productNotFoundText")}</p>
          <Link to="/products" className="mt-7 inline-flex rounded-full bg-[#173f35] px-6 py-3 text-sm font-bold text-white">
            {t("backToCatalog")}
          </Link>
        </div>
      </main>
    )
  }

  const priceWithVat = product.priceExVat * (1 + product.vatRate / 100)
  const specification = [
    [t("catalogNumber"), product.sku],
    [t("brand"), product.brand],
    [t("package"), product.package],
    [t("minOrder"), `${product.minOrder} ${t("pieces")}`],
  ]

  return (
    <main className="bg-[#f6f2e8] px-4 py-8 text-[#173f35] sm:px-6 sm:py-12 lg:px-8">
      <div className="mx-auto max-w-7xl">
        <Link to="/products" className="inline-flex items-center gap-2 text-sm font-bold text-[#526b60] transition hover:text-[#173f35]">
          <span aria-hidden="true">←</span> {t("backToCatalog")}
        </Link>

        <section className="mt-7 grid gap-8 lg:grid-cols-[1fr_0.95fr] lg:gap-14">
          <div className="overflow-hidden rounded-[2rem] bg-[#e8eadb]">
            <img src={product.image} alt={productName(product)} className="aspect-[5/4] h-full w-full object-cover" />
          </div>

          <div className="flex flex-col justify-center py-2 lg:py-8">
            <div className="flex flex-wrap items-center gap-2">
              <span className="rounded-full bg-[#dce9b6] px-3 py-1.5 text-xs font-bold text-[#173f35]">{categoryLabel(product.category)}</span>
              <span className="rounded-full border border-[#173f35]/12 px-3 py-1.5 text-xs font-bold text-[#526b60]">{product.brand}</span>
            </div>
            <h1 className="mt-5 font-serif text-5xl leading-[1.02] tracking-[-0.04em] sm:text-6xl">{productName(product)}</h1>
            <p className="mt-6 max-w-2xl text-base leading-7 text-[#526b60] sm:text-lg">{productDescription(product)}</p>

            <div className="mt-6 flex flex-wrap gap-2">
              {product.tags.map((tag) => (
                <span key={tag} className="rounded-full bg-white/70 px-3 py-1.5 text-xs font-semibold text-[#526b60]">
                  {tagLabel(tag)}
                </span>
              ))}
            </div>

            <div className="mt-8 grid grid-cols-2 overflow-hidden rounded-[1.5rem] border border-[#173f35]/10 bg-white">
              <div className="p-5 sm:p-6">
                <span className="text-xs font-bold uppercase tracking-[0.14em] text-[#78877f]">{t("excludingVat")}</span>
                <strong className="mt-2 block text-2xl">{formatCurrency(product.priceExVat, language)}</strong>
                <span className="mt-1 block text-xs text-[#78877f]">{t("perPiece")}</span>
              </div>
              <div className="border-l border-[#173f35]/10 p-5 sm:p-6">
                <span className="text-xs font-bold uppercase tracking-[0.14em] text-[#78877f]">{t("includingVat")}</span>
                <strong className="mt-2 block text-2xl">{formatCurrency(priceWithVat, language)}</strong>
                <span className="mt-1 block text-xs text-[#78877f]">{t("vat")} {product.vatRate} %</span>
              </div>
            </div>
          </div>
        </section>

        <section className="mt-12 grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
          <div className="rounded-[1.75rem] bg-[#173f35] p-7 text-white sm:p-9">
            <p className="text-xs font-black uppercase tracking-[0.18em] text-[#dce9b6]">{t("b2bInfo")}</p>
            <dl className="mt-6 divide-y divide-white/12">
              {specification.map(([label, value]) => (
                <div key={label} className="flex items-center justify-between gap-5 py-4 first:pt-0 last:pb-0">
                  <dt className="text-sm text-white/65">{label}</dt>
                  <dd className="text-right text-sm font-bold">{value}</dd>
                </div>
              ))}
            </dl>
          </div>

          <div className="rounded-[1.75rem] border border-[#173f35]/10 bg-white/65 p-7 sm:p-9">
            <div className="grid gap-7 sm:grid-cols-3">
              {[t("composition"), t("allergens"), t("nutrition")].map((heading) => (
                <div key={heading}>
                  <h2 className="text-sm font-bold text-[#173f35]">{heading}</h2>
                  <p className="mt-3 text-sm leading-6 text-[#6a7a72]">{t("placeholderToComplete")}</p>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="mt-6 rounded-[2rem] bg-[#dce9b6] px-7 py-9 sm:flex sm:items-center sm:justify-between sm:gap-8 sm:px-10">
          <div className="max-w-2xl">
            <h2 className="font-serif text-3xl tracking-[-0.03em]">{t("contactForOrder")}</h2>
            <p className="mt-3 leading-7 text-[#4e665c]">{t("contactForOrderText")}</p>
          </div>
          <Link to="/contact" className="mt-6 inline-flex shrink-0 rounded-full bg-[#173f35] px-6 py-3.5 text-sm font-bold text-white transition hover:bg-[#285b4c] sm:mt-0">
            {t("contactMatro")} <span className="ml-2" aria-hidden="true">→</span>
          </Link>
        </section>
      </div>
    </main>
  )
}
