export default function Filters({
  query, setQuery,
  categories, selectedCats, setSelectedCats
}) {
  return (
    <section className="flex flex-col gap-3 rounded-2xl bg-emerald-200 p-4">
      <div className="flex items-center gap-3">
        <input
          value={query}
          onChange={(e) => setQuery(e.target.value)}
          placeholder="Hledat produkty..."
          className="flex-1 rounded-xl bg-white px-3 py-2 text-sm text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-300"
        />
      </div>

      {/* Kategorie */}
      <div>
        <div className="flex items-center justify-between mb-2">
          <p className="text-xs uppercase tracking-wide text-black">Kategorie</p>
          {selectedCats.length > 0 && (
            <button
              onClick={() => setSelectedCats([])}
              className="w-6 h-6 flex items-center justify-center rounded-full bg-emerald-200 text-red-600 text-sm hover:bg-red-200 transition"
              title="Zrušit výběr"
            >
              ❌
            </button>
          )}
        </div>

        <div className="flex flex-wrap gap-2">
          {categories.map((c) => {
            const active = selectedCats.includes(c);
            return (
              <button
                key={c}
                onClick={() =>
                  setSelectedCats((prev) =>
                    active ? prev.filter((x) => x !== c) : [...prev, c]
                  )
                }
                className={
                  "rounded-full px-3 py-1 text-sm transition " +
                  (active
                    ? "bg-emerald-400 text-black"
                    : "bg-white text-black hover:bg-emerald-100")
                }
              >
                {c}
              </button>
            );
          })}
        </div>
      </div>
    </section>
  );
}
