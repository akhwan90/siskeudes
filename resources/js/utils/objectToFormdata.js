export function objectToFormData(obj, formData = new FormData(), parentKey = "") {
    for (const key in obj) {
        if (obj.hasOwnProperty(key)) {
            const value = obj[key];
            const fullKey = parentKey ? `${parentKey}[${key}]` : key;

            if (value instanceof File) {
                // Jika value adalah file, langsung append
                formData.append(fullKey, value);
            } else if (Array.isArray(value)) {
                // Jika value adalah array, lakukan append untuk setiap item
                value.forEach((item, index) => {
                    objectToFormData({ [`${key}[${index}]`]: item }, formData, parentKey);
                });
            } else if (typeof value === "object" && value !== null) {
                // Jika value adalah object, rekursif untuk masuk ke dalamnya
                objectToFormData(value, formData, fullKey);
            } else {
                // Jika value adalah string, number, boolean, dll., langsung append
                formData.append(fullKey, value);
            }
        }
    }
    return formData;
}
