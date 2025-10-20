import { InertiaLinkProps } from "@inertiajs/vue3";
import { clsx, type ClassValue } from "clsx";
import { twMerge } from "tailwind-merge";

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function urlIsActive(urlToCheck: NonNullable<InertiaLinkProps["href"]>, currentUrl: string) {
    return toUrl(urlToCheck) === currentUrl;
}

export function toUrl(href: NonNullable<InertiaLinkProps["href"]>) {
    return typeof href === "string" ? href : href?.url;
}

export function money(value: number | undefined | null) {
    if (value === null || value === undefined) value = 0;
    return new Intl.NumberFormat("ru-RU", {
        style: "currency",
        currency: "RUB",
        currencyDisplay: "narrowSymbol",
        currencySign: "standard",
        useGrouping: true,
        minimumFractionDigits: 0,
    }).format(value);
}
