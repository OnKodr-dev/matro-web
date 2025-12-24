import { Link } from "react-router-dom"

export default function ProductCard({ product, onOpen }) {
  return (
    <article className="group relative overflow-hidden rounded-2xl border border-gray-200 bg-emerald-200 hover:border-gray-300 transition">
      {/* Kliknutí na obrázek otevře modal */}
      <div
        className="aspect-[4/3] overflow-hidden cursor-pointer"
        onClick={() => onOpen(product)}
      >
        <img
          src={product.image}
          alt={product.name}
          className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
          loading="lazy"
        />
      </div>

      <div className="p-4 flex flex-col gap-2">
        <div className="flex items-start justify-between gap-2">
          <h3 className="text-gray-900 font-semibold leading-tight">{product.name}</h3>
          <span className="shrink-0 rounded-full bg-emerald-50 px-2.5 py-1 text-xs text-emerald-700 border border-emerald-200">
            {product.category}
          </span>
        </div>

        <div className="flex items-center justify-between">
          <span className="text-gray-700 font-medium">
            {new Intl.NumberFormat("cs-CZ", { style: "currency", currency: "CZK" }).format(product.price)}/ks
          </span>

          {/* Kliknutí na Detail = navigace na /product/:slug */}
          <Link
            to={`/product/${product.slug}`}
            className="rounded-xl bg-gray-900 text-white px-3 py-1.5 text-sm font-semibold hover:bg-black"
          >
            Detail
          </Link>
        </div>
      </div>
    </article>
  )
}
