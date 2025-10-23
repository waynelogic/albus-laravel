import { InertiaLinkProps } from "@inertiajs/vue3";
import type { LucideIcon } from "lucide-vue-next";

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps["href"]>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface BlogCategory {
    id: number;
    name: string;
    slug?: string;
    preview_text: string;
    icon: any;
    created_at?: string;
    updated_at?: string;
}

export interface BlogPost {
    id: number;
    title: string;
    slug: string;
    preview_text: string;
    content?: string;
    category?: BlogCategory;
    published_at: string;
    cover_url?: string;
    created_at: string;
    updated_at: string;
}

export type ServiceCategory = {
    id: number;
    name: string;
    slug?: string;
    preview_text: string;
    icon: any;
    created_at?: string;
    updated_at?: string;
};

export interface Partner {
    id: number;
    name: string;
    slug: string;
    preview_text?: string;
    logo_url?: string;
    created_at: string;
    updated_at: string;
}
