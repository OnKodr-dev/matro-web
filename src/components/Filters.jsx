import useLanguage from "../hooks/useLanguage"

export default function Filters({
  query,
  setQuery,
  categories,
  selectedCats,
  setSelectedCats,
  sortBy,
  setSortBy,
}) {
  const { categoryLabel, t } = useLanguage()

  return (
    <section className="rounded-[1.75rem] border border-[#173f35]/10 bg-white/75 p-4 shadow-[0_24px_60px_-45px_rgba(23,63,53,0.45)] backdrop-blur sm:p-6">
      <div className="grid gap-3 md:grid-cols-[1fr_auto]">
        <label className="relative block">
          <span className="sr-only">{t("searchLabel")}</span>
          <span className="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-[#708279]" aria-hidden="true">⌕</span>
          <input
            value={query}
            onChange={(event) => setQuery(event.target.value)}
            placeholder={t("searchProducts")}
            className="h-12 w-full rounded-full border border-[#173f35]/12 bg-[#f8f6ef] pl-11 pr-4 text-sm text-[#173f35] outline-none transition placeholder:text-[#7f8c86] focus:border-[#55756a] focus:ring-4 focus:ring-[#dce9b6]/60"
          />
        </label>

        <label className="flex h-12 items-center gap-2 rounded-full border border-[#173f35]/12 bg-[#f8f6ef] px-4">
          <span className="whitespace-nowrap text-xs font-bold uppercase tracking-[0.14em] text-[#6e7e77]">{t("sorting")}</span>
          <select
            value={sortBy}
            onChange={(event) => setSortBy(event.target.value)}
            className="min-w-0 bg-transparent text-sm font-semibold text-[#173f35] outline-none"
          >
            <option value="relevance">{t("relevance")}</option>
            <option value="name-asc">{t("nameAsc")}</option>
            <option value="price-asc">{t("priceAsc")}</option>
            <option value="price-desc">{t("priceDesc")}</option>
          </select>
        </label>
      </div>

      <div className="mt-5 border-t border-[#173f35]/8 pt-5">
        <div className="mb-3 flex items-center justify-between gap-3">
          <p className="text-xs font-bold uppercase tracking-[0.16em] text-[#6e7e77]">{t("categories")}</p>
          {selectedCats.length > 0 && (
            <button
              type="button"
              onClick={() => setSelectedCats([])}
              className="text-xs font-bold text-[#a55738] underline decoration-[#a55738]/35 underline-offset-4 transition hover:decoration-[#a55738]"
            >
              {t("clearFilters")}
            </button>
          )}
        </div>

        <div className="flex flex-wrap gap-2">
          {categories.map((category) => {
            const active = selectedCats.includes(category)
            return (
              <button
                type="button"
                key={category}
                onClick={() =>
                  setSelectedCats((current) =>
                    active ? current.filter((item) => item !== category) : [...current, category]
                  )
                }
                className={`rounded-full border px-3.5 py-2 text-xs font-semibold transition sm:text-sm ${
                  active
                    ? "border-[#173f35] bg-[#173f35] text-white"
                    : "border-[#173f35]/10 bg-[#f8f6ef] text-[#36544a] hover:border-[#173f35]/30 hover:bg-[#edf1df]"
                }`}
                aria-pressed={active}
              >
                {categoryLabel(category)}
              </button>
            )
          })}
        </div>
      </div>
    </section>
  )
}
