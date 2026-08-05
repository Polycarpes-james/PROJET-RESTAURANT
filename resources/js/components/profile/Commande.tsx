import { useLoaderData } from "react-router-dom";

export default function CommandeIndexPage () {
    const data = useLoaderData()
    console.log(data);
    
    return <div className="belongToUser">        
        <h1>commande</h1>
        {  data.plats.map((plat:any) => (
                           <div>{plat.name}</div>
                        ))}
        {/* {avis.map(avi => {
            <p>{ avi.note }</p>
            <p>{ avi.plat.name }</p>
            <p>{ avi.commentaire }</p>
            })   
        } */}
    </div>
}