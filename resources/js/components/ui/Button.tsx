import { ButtonHTMLAttributes } from "react";

interface ButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {}

export default function Button({
    children,
    ...props
}: ButtonProps) {
    return (
        <button {...props}>
            {children}
        </button>
    );
}