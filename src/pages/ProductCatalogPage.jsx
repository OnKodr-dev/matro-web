import { useMemo, useState } from "react";
import { PRODUCTS, CATEGORIES } from "../data/products";
import ProductCard from "../components/ProductCard";
import Filters from "../components/Filters";
import Modal from "../components/Modal";

const czCurrency = (value) =>
  new Intl.NumberFormat("cs-CZ", { style: "currency", currency: "CZK" }).format(value);

export default function ProductCatalogPage() {
  const [query, setQuery] = useState("");
  const [selectedCats, setSelectedCats] = useState([]);
  const [price, _setPrice] = useState({ min: 0, max: 999999 });
  const [sortBy, setSortBy] = useState("relevance");
  const [open, setOpen] = useState(false);
  const [active, setActive] = useState(null);

  const filtered = useMemo(() => {
    let items = PRODUCTS.filter((p) =>
      [p.name, p.description, p.tags.join(" "), p.category]
        .join(" ")
        .toLowerCase()
        .includes(query.toLowerCase())
    );

    if (selectedCats.length) {
      items = items.filter((p) => selectedCats.includes(p.category));
    }

    items = items.filter((p) => p.price >= price.min && p.price <= price.max);

    switch (sortBy) {
      case "price-asc":
        items.sort((a, b) => a.price - b.price);
        break;
      case "price-desc":
        items.sort((a, b) => b.price - a.price);
        break;
      case "name-asc":
        items.sort((a, b) => a.name.localeCompare(b.name, "cs"));
        break;
      default:
        if (query.trim()) {
          const q = query.toLowerCase();
          items.sort((a, b) => {
            const aName = a.name.toLowerCase().includes(q) ? 1 : 0;
            const bName = b.name.toLowerCase().includes(q) ? 1 : 0;
            if (aName !== bName) return bName - aName;
            return a.name.localeCompare(b.name, "cs");
          });
        } else {
          items.sort((a, b) => a.name.localeCompare(b.name, "cs"));
        }
    }
    return items;
  }, [query, selectedCats, price, sortBy]);

  function openDetail(p) {
    setActive(p);
    setOpen(true);
  }

  return (
    <div className="bg-white text-gray-900">
      <main className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <Filters
          query={query}
          setQuery={setQuery}
          categories={CATEGORIES}
          selectedCats={selectedCats}
          setSelectedCats={setSelectedCats}
          sortBy={sortBy}
          setSortBy={setSortBy}
        />

        <div className="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {filtered.map((p) => (
            <ProductCard key={p.id} product={p} onOpen={openDetail} />
          ))}
          {filtered.length === 0 && (
            <div className="col-span-full text-center text-gray-500 py-12 border border-dashed border-gray-300 rounded-2xl">
              Žádné položky neodpovídají filtru.
            </div>
          )}
        </div>
      </main>

      <Modal open={open} onClose={() => setOpen(false)} title={active?.name}>
        {active && (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <img src={active.image} alt={active.name} className="w-full rounded-xl border border-gray-200" />
            <div className="flex flex-col gap-3">
              <div className="flex items-center justify-between">
                <span className="rounded-full bg-emerald-50 px-2.5 py-1 text-xs text-emerald-700 border border-emerald-200">
                  {active.category}
                </span>
              </div>

              <p className="text-gray-700">{active.description}</p>

              <div className="flex flex-wrap gap-2">
                {active.tags.map((t) => (
                  <span key={t} className="rounded-full border border-gray-300 bg-white px-2 py-1 text-xs text-gray-700">
                    {t}
                  </span>
                ))}
              </div>

              {/* CENA + BALENÍ */}
              <div className="mt-2 flex items-center justify-between">
                <span className="text-lg font-semibold">{czCurrency(active.price)}</span>
                {active.package && (
                  <span className="text-sm text-gray-600">
                    Balení: <span className="font-medium text-gray-800">{active.package}</span>
                  </span>
                )}
              </div>
            </div>
          </div>
        )}
      </Modal>
    </div>
  );
}
