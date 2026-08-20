import { useEffect } from "react"
import useLanguage from "../hooks/useLanguage"

export default function Modal({ open, onClose, children, title }) {
  const { t } = useLanguage()

  useEffect(() => {
    if (!open) return undefined

    const handleKeyDown = (event) => {
      if (event.key === "Escape") onClose()
    }

    window.addEventListener("keydown", handleKeyDown)
    return () => window.removeEventListener("keydown", handleKeyDown)
  }, [onClose, open])

  if (!open) return null

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-8" onMouseDown={onClose}>
      <div className="absolute inset-0 bg-[#102d25]/70 backdrop-blur-sm" />
      <div
        className="relative max-h-[90vh] w-full max-w-3xl overflow-y-auto rounded-[2rem] bg-[#f8f6ef] shadow-2xl"
        onMouseDown={(event) => event.stopPropagation()}
        role="dialog"
        aria-modal="true"
        aria-label={title}
      >
        <div className="sticky top-0 z-10 flex items-center justify-between border-b border-[#173f35]/10 bg-[#f8f6ef]/95 px-5 py-4 backdrop-blur sm:px-7">
          <p className="pr-4 text-lg font-semibold text-[#173f35]">{title}</p>
          <button
            type="button"
            onClick={onClose}
            className="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-[#173f35]/12 text-xl text-[#173f35] transition hover:bg-[#e8eadb]"
            aria-label={t("close")}
          >
            ×
          </button>
        </div>
        <div className="p-5 sm:p-7">{children}</div>
      </div>
    </div>
  )
}
