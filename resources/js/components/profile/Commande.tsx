import { CommandeIndex } from "@/interfaces/profile";

export default function CommandeIndexPage ({commande, plats}: CommandeIndex) {
    return <div className="belongToUser">
        
        <h1>commande</h1>
        {/* /* {plats.map((plat => {
            <p>{ plat.name }</p>
        })) }
        {avis.map(avi => {
            <p>{ avi.note }</p>
            <p>{ avi.plat.name }</p>
            <p>{ avi.commentaire }</p>
            })   
        }*/}
    </div>
}