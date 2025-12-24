// src/pages/AboutPage.jsx
export default function AboutPage() {
    return (
      <div className="bg-white text-gray-800">
        <div className="mx-auto max-w-3xl px-4 py-16">
          <h1 className="text-3xl font-extrabold text-black mb-6 pb-2">
            O společnosti
          </h1>
  
          <div className="space-y-5 leading-relaxed text-lg">
            <p>
              <span className="font-semibold">Společnost MATRO</span> se zabývá prodejem BIO potravin vyrobených z ekologicky
              kontrolovaného růstu.
            </p>
            <p>
              Naše biopotraviny splňují <span className="font-medium">nejvyšší standardy kvality</span>, dosažené
              tradičními zemědělskými postupy, které respektují přírodu i zdraví spotřebitelů.
            </p>
            <p>
              V naší nabídce najdete také produkty belgické firmy{" "}
              <span className="text-emerald-700 font-semibold">LIMA</span>, která patří mezi přední výrobce biopotravin v Evropě.
            </p>
          </div>
  
          <div className="mt-10 p-6 bg-emerald-100 rounded-2xl">
            <h2 className="text-xl font-bold text-black mb-3">Naše poslání</h2>
            <p>
              Přinášet na český trh kvalitní biopotraviny, které podporují zdravý životní styl a ohleduplnost k životnímu prostředí.
            </p>
          </div>
        </div>
      </div>
    )
  }
  