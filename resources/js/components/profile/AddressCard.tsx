import { LucidePencil, Pen, Pencil, PencilIcon } from "lucide-react";

interface Props {
    country?: string;
    city?: string;
    department?: string;
}

export default function AddressCard({
    country,
    city,
    department
}: Props) {

    return (
        <section className="card">
            <div className="card-header">
                <h2>Adresse</h2>
                <button className="btn-edit"><Pencil width={18} /></button>
            </div>
            <div className="grille-infos">
                <div className="item">
                    <span>Pays</span>
                    <strong>{country ?? "-"}</strong>
                </div>
                <div className="item">
                    <span>Ville</span>
                    <strong>{city ?? "-"}</strong>
                </div>
                <div className="item">
                    <span>Département</span>
                    <strong>{department ?? "-"}</strong>
                </div>
            </div>
        </section>

    );
}