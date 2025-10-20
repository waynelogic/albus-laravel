import { PhClock, PhMailbox, PhMapPin, PhPhone } from "@phosphor-icons/vue";

type Contact = {
    title: string;
    content: string;
    shortContent?: string;
    href?: string;
    icon: any;
};
type ContactsDB = {
    [key: string]: Contact;
};
export const contactsDB: ContactsDB = {
    phone: {
        title: "Телефон",
        content: "+7 (989) 5-1234-44",
        href: "tel:+79895123444",
        icon: PhPhone,
    },
    email: {
        title: "E-mail",
        content: "info@albus-it.ru",
        href: "mailto:info@albus-it.ru",
        icon: PhMailbox,
    },
    address: {
        title: "Адрес",
        content: "г. Ростов-на-Дону, Нансена ул., 105",
        href: "https://yandex.ru/profile/1262486648",
        icon: PhMapPin,
    },
    workingHours: {
        title: "График работы",
        content: `Понедельник - Пятница: 9:00 - 18:00 </br> Суббота - Воскресенье: Выходной`,
        shortContent: "Пн-Пт: 9:00 - 18:00",
        icon: PhClock,
    },
};

// --- Your new code starts here ---

const { workingHours, ...contactsDBshort } = contactsDB;

export { contactsDBshort };
