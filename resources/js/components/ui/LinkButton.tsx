import { AnchorHTMLAttributes } from "react";

interface LinkButtonProps extends AnchorHTMLAttributes<HTMLAnchorElement> {}

export default function LinkButton({
    children,
    ...props
}: LinkButtonProps) {
    return (
        <a {...props}>
            {children}
        </a>
    );
}