import useLanguage from "../hooks/useLanguage"
import PageIntro from "../components/PageIntro"

export default function AboutPage() {
  const { t } = useLanguage()
  const values = [
    [t("valuesQuality"), t("valuesQualityText")],
    [t("valuesTrust"), t("valuesTrustText")],
    [t("valuesExperience"), t("valuesExperienceText")],
  ]

  return (
    <main className="bg-[#f6f2e8] px-4 py-8 text-[#173f35] sm:px-6 sm:py-12 lg:px-8">
      <div className="mx-auto max-w-7xl">
        <PageIntro
          eyebrow={t("aboutEyebrow")}
          title={t("aboutTitle")}
          lead={t("aboutLead")}
        />

        <section className="grid gap-8 py-16 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20 lg:py-24">
          <div>
            <p className="text-xs font-black uppercase tracking-[0.2em] text-[#a45d3d]">MATRO Praha, s.r.o.</p>
            <h2 className="mt-4 font-serif text-4xl tracking-[-0.03em] sm:text-5xl">{t("mission")}</h2>
          </div>
          <div className="space-y-5 text-base leading-8 text-[#526b60] sm:text-lg">
            <p>{t("aboutBody1")}</p>
            <p>{t("aboutBody2")}</p>
          </div>
        </section>

        <section className="grid gap-px overflow-hidden rounded-[2rem] bg-[#173f35]/10 sm:grid-cols-3">
          {values.map(([title, description]) => (
            <article key={title} className="bg-white/70 p-7 sm:p-8">
              <h2 className="text-xl font-semibold">{title}</h2>
              <p className="mt-3 text-sm leading-6 text-[#60736c]">{description}</p>
            </article>
          ))}
        </section>
      </div>
    </main>
  )
}
