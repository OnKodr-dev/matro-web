import { useParams, Link } from "react-router-dom"
import { PRODUCTS } from "../data/products"

const czCurrency = (v) =>
  new Intl.NumberFormat("cs-CZ", { style: "currency", currency: "CZK" }).format(v)

export default function ProductDetailPage() {
  const { slug } = useParams()
  const product = PRODUCTS.find(p => p.slug === slug)

  if (!product) {
    return (
      <div className="min-h-screen bg-white text-gray-900 flex items-center justify-center px-4">
        <div className="max-w-xl text-center">
          <h1 className="text-2xl font-bold mb-2">Produkt nebyl nalezen</h1>
          <p className="text-gray-600 mb-6">Zkontrolujte URL nebo se vraťte do katalogu.</p>
          <Link to="/" className="rounded-xl bg-gray-900 text-white px-4 py-2 font-semibold hover:bg-black">
            Zpět do katalogu
          </Link>
        </div>
      </div>
    )
  }

  return (
    <div className="min-h-screen bg-white text-gray-900">

      {/* Obsah */}
      <main className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <Link to="/" className="text-sm text-gray-500 hover:text-gray-900">&larr; Zpět do katalogu</Link>

        <div className="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
          <img
            src={product.image}
            alt={product.name}
            className="w-full rounded-2xl border border-gray-200 object-cover"
          />

          <div className="flex flex-col gap-4">
            <div>
              <span className="rounded-full bg-emerald-50 px-2.5 py-1 text-xs text-emerald-700 border border-emerald-200">
                {product.category}
              </span>
              <h2 className="text-2xl font-bold mt-3">{product.name}</h2>
            </div>

            <p className="text-gray-700">{product.description}</p>

            <div className="flex flex-wrap gap-2">
              {product.tags?.map((t) => (
                <span key={t} className="rounded-full border border-gray-300 bg-white px-2 py-1 text-xs text-gray-700">
                  {t}
                </span>
              ))}
            </div>

            <div className="mt-2 text-xl font-semibold">{czCurrency(product.price)}</div>
          </div>
        </div>

        {/* Místo pro další sekce */}
        <section className="mt-10 rounded-2xl border border-gray-200 bg-gray-50 p-6">
          <h3 className="text-lg font-semibold mb-3">Technické parametry</h3>
          <ul className="grid grid-cols-1 sm:grid-cols-2 gap-2 text-gray-700">
            <li>• Napájení: PoE</li>
            <li>• Konektivita: Ethernet / LTE (volitelně)</li>
            <li>• Rozhraní: Modbus, RS485</li>
            <li>• Krytí: IP67</li>
          </ul>
        </section>
      </main>
    </div>
  )
}
