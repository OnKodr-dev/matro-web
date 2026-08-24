import useLanguage from "../hooks/useLanguage"
import PageIntro from "../components/PageIntro"

export default function ContactPage() {
  const { t } = useLanguage()
  const contacts = [
    [t("phone"), t("placeholderPhone"), t("availability")],
    [t("email"), t("placeholderEmail"), "B2B / wholesale"],
    [t("address"), t("placeholderAddress"), "Praha, Česká republika"],
  ]

  return (
    <main id="kontakt" className="bg-[#f6f2e8] px-4 py-8 text-[#173f35] sm:px-6 sm:py-12 lg:px-8">
      <div className="mx-auto max-w-7xl">
        <PageIntro
          eyebrow={t("contactEyebrow")}
          title={t("contactTitle")}
          lead={t("contactLead")}
          metric="B2B"
          metricLabel="MATRO Praha, s.r.o."
        />

        <section className="grid gap-px overflow-hidden rounded-[2rem] bg-[#173f35]/10 my-8 lg:grid-cols-3">
          {contacts.map(([label, value, note]) => (
            <article key={label} className="bg-white/75 p-7 sm:p-8">
              <h2 className="text-sm font-bold uppercase tracking-[0.14em] text-[#718078]">{label}</h2>
              <p className="mt-3 text-xl font-semibold text-[#173f35]">{value}</p>
              <p className="mt-2 text-sm text-[#60736c]">{note}</p>
            </article>
          ))}
        </section>

        <section className="grid gap-8 py-10 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20 lg:py-16">
          <div>
            <p className="text-xs font-black uppercase tracking-[0.2em] text-[#a45d3d]">{t("companyDetails")}</p>
            <h2 className="mt-4 font-serif text-4xl tracking-[-0.03em]">MATRO Praha, s.r.o.</h2>
          </div>
          <dl className="divide-y divide-[#173f35]/10 rounded-[1.75rem] border border-[#173f35]/10 bg-white/55 px-6 sm:px-8">
            <div className="flex items-center justify-between gap-6 py-5">
              <dt className="text-sm text-[#60736c]">IČO</dt>
              <dd className="font-bold">27564541</dd>
            </div>
            <div className="flex items-center justify-between gap-6 py-5">
              <dt className="text-sm text-[#60736c]">DIČ / VAT ID</dt>
              <dd className="font-bold">CZ27564541</dd>
            </div>
            <div className="flex items-center justify-between gap-6 py-5">
              <dt className="text-sm text-[#60736c]">Web</dt>
              <dd className="font-bold">www.matro.cz</dd>
            </div>
          </dl>
        </section>
      </div>
    </main>
  )
}
