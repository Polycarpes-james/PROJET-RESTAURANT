import { XIcon } from "lucide-react";
import { ReactNode, useEffect } from "react";

interface ModalProps {
    open: boolean;
    onClose: () => void;
    title?: string;
    children: ReactNode;
}

export default function Modal({
    open,
    onClose,
    title,
    children,
}: ModalProps) {

    useEffect(() => {

        if (!open) return;

        document.body.style.overflow = "hidden";

        const handleEscape = (e: KeyboardEvent) => {
            if (e.key === "Escape") {
                onClose();
            }
        };

        window.addEventListener("keydown", handleEscape);

        return () => {
            document.body.style.overflow = "";
            window.removeEventListener("keydown", handleEscape);
        };

    }, [open]);

    if (!open) return null;
    
    return (
        <aside id="admin_item_delete" className="modal" onClick={onClose}>
            <div className="admin_item_content" onClick={(e) => e.stopPropagation()}>
                <header className="admin_item_header">
                    <div className="title-category">
                        {title && <h3 id="item-font">{title}</h3>}
                        <button onClick={onClose} className="modal-close-admin"><XIcon/></button>
                    </div>
                </header>   
                <main className="admin_item_main">{children}</main>
                {/* <footer className="{{ $footerClass }}">
                    @if (!$slot)
                        <button type="submit" className="{{ $kind }}">Ok</button>
                    @endif
                </footer> */}
            </div>
        </aside>
    );
}