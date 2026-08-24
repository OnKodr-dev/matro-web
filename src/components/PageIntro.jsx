export default function PageIntro({ eyebrow, title, lead, metric, metricLabel }) {
  return (
    <section className="border-b border-[#173f35]/15 pb-16 pt-10 sm:pb-20 sm:pt-16 lg:grid lg:min-h-[460px] lg:grid-cols-[1.25fr_0.75fr] lg:items-start lg:gap-20 lg:pb-24 lg:pt-20">
      <div className="max-w-4xl">
        <p className="text-xs font-black uppercase tracking-[0.2em] text-[#9a5639]">{eyebrow}</p>
        <h1 className="mt-7 font-serif text-5xl leading-[1.01] tracking-[-0.045em] text-[#173f35] sm:text-6xl lg:text-[5rem]">
          {title}
        </h1>
      </div>

      <div className="mt-12 border-t border-[#173f35]/20 pt-7 lg:mt-0">
        <p className="text-lg font-semibold leading-8 text-[#36544a]">{lead}</p>
        {metric != null && metricLabel && (
          <div className="mt-12 flex items-end justify-between gap-6 border-t border-[#173f35]/10 pt-6">
            <span className="font-serif text-6xl leading-none tracking-[-0.04em] text-[#173f35]">{metric}</span>
            <p className="max-w-[180px] text-right text-[11px] font-bold uppercase leading-5 tracking-[0.14em] text-[#7a665b]">
              {metricLabel}
            </p>
          </div>
        )}
      </div>
    </section>
  )
}
