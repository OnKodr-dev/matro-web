import useLanguage from "../hooks/useLanguage"
import PageIntro from "../components/PageIntro"

export default function AboutPage() {
  const { t } = useLanguage()
  const values = [
    ["01", t("valuesQuality"), t("valuesQualityText")],
    ["02", t("valuesTrust"), t("valuesTrustText")],
    ["03", t("valuesExperience"), t("valuesExperienceText")],
  ]

  return (
    <main className="bg-[#f6f2e8] px-4 py-8 text-[#173f35] sm:px-6 sm:py-12 lg:px-8">
      <div className="mx-auto max-w-7xl">
        <PageIntro
          eyebrow={t("aboutEyebrow")}
          title={t("aboutTitle")}
          lead={t("aboutLead")}
          metric="2000"
          metricLabel={t("aboutBadge")}
        />

        <section className="grid gap-8 py-16 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20 lg:py-24">
          <div>
            <p className="text-xs font-black uppercase tracking-[0.2em] text-[#a45d3d]">MATRO Praha, s.r.o.</p>
            <h2 className="mt-4 font-serif text-4xl tracking-[-0.03em] sm:text-5xl">{t("mission")}</h2>
          </div>
          <div className="space-y-5 text-base leading-8 text-[#526b60] sm:text-lg">
            <p>{t("aboutBody1")}</p>
            <p>{t("aboutBody2")}</p>
            <blockquote className="mt-8 border-l-4 border-[#e5794b] pl-6 font-serif text-2xl leading-9 text-[#173f35] sm:text-3xl">
              {t("missionText")}
            </blockquote>
          </div>
        </section>

        <section className="grid gap-px overflow-hidden rounded-[2rem] bg-[#173f35]/10 sm:grid-cols-3">
          {values.map(([number, title, description]) => (
            <article key={number} className="bg-white/70 p-7 sm:p-8">
              <span className="text-xs font-black tracking-[0.18em] text-[#c26a45]">{number}</span>
              <h2 className="mt-6 text-xl font-semibold">{title}</h2>
              <p className="mt-3 text-sm leading-6 text-[#60736c]">{description}</p>
            </article>
          ))}
        </section>
      </div>
    </main>
  )
}
