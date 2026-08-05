import { ShoppingCart } from  "lucide-react";
import Text from "../ui/text";
import { useProfile } from "@/context/ProfileContext";


export default function Cart() {
    const { data } = useProfile()
    const { panier } = data
    
    return (
        <div className="panier-user">
            <div className="header-line">
                <div className="panier-icon">
                    <span className="total-number-plats">
                        <ShoppingCart />
                        <p>Panier</p>
                        <small>{data.total}</small>
                    </span>
                </div>
                <div className="panier-plats">
                    {panier?.plats ? (
                        panier.plats.map((plat:any) => (
                            <div key={plat.plat_id} className="plat-item">
                                <div className="item">
                                    <div className="head">
                                        <p className="name"><Text children={plat.name} limit={11}/></p>
                                        <p className="price">{plat.pivot.prix_total}€</p>
                                    </div>
                                    <div className="quantite-total">
                                        <p>{plat.pivot.quantite}×{plat.price}€</p>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (<p>Aucun plat.</p>)}
                </div>
            </div>
        </div>
    );
}