import { Panier } from "../../interfaces/profile";

interface Props {
    panier?: Panier;
    total: number;
}

export default function Cart({
    panier,
    total,
}: Props) {

    return (

        <div className="panier-user">

            <div className="header-line">

                <div className="panier-icon">

                    <span className="total-number-plats">

                        🛒

                        <p>Panier</p>

                        <small>{total}</small>

                    </span>

                </div>

                <div className="panier-plats">

                    {panier?.plats.length ? (

                        panier.plats.map((plat) => (

                            <div
                                key={plat.id}
                                className="plat-item"
                            >

                                <div className="item">

                                    <div className="head">

                                        <p className="name">
                                            {plat.name}
                                        </p>

                                        <p className="price">
                                            {plat.prix_total}€
                                        </p>

                                    </div>

                                    <div className="quantite-total">

                                        <p>

                                            {plat.quantite}
                                            ×
                                            {plat.price}€

                                        </p>

                                    </div>

                                </div>

                            </div>

                        ))

                    ) : (

                        <p>Aucun plat.</p>

                    )}

                </div>

            </div>

        </div>

    );
}