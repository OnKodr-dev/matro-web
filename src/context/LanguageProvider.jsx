import { useEffect, useMemo, useState } from "react"
import LanguageContext from "./language-context"
import { CATEGORY_TRANSLATIONS, TAG_TRANSLATIONS, TRANSLATIONS } from "../i18n/translations"

export default function LanguageProvider({ children }) {
  const [language, setLanguage] = useState(() => {
    try {
      return window.localStorage.getItem("matro-language") === "en" ? "en" : "cs"
    } catch {
      return "cs"
    }
  })

  useEffect(() => {
    document.documentElement.lang = language
    try {
      window.localStorage.setItem("matro-language", language)
    } catch {
      // The preference simply stays in memory when browser storage is unavailable.
    }
  }, [language])

  const value = useMemo(() => {
    const t = (key) => TRANSLATIONS[language][key] ?? TRANSLATIONS.cs[key] ?? key
    const categoryLabel = (category) => language === "en" ? CATEGORY_TRANSLATIONS[category] ?? category : category
    const tagLabel = (tag) => language === "en" ? TAG_TRANSLATIONS[tag] ?? tag : tag
    const productName = (product) => language === "en" ? product.nameEn ?? product.name : product.name
    const productDescription = (product) => language === "en" ? product.descriptionEn ?? product.description : product.description

    return {
      language,
      setLanguage,
      toggleLanguage: () => setLanguage((current) => current === "cs" ? "en" : "cs"),
      t,
      categoryLabel,
      tagLabel,
      productName,
      productDescription,
    }
  }, [language])

  return <LanguageContext.Provider value={value}>{children}</LanguageContext.Provider>
}
