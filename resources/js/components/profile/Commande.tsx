import { Suspense } from "react";
import { Await, useLoaderData } from "react-router-dom";
import UserCardSkeleton from "../UserSkeleton";
import { CheckCircle2Icon, CircleXIcon, EditIcon, InfoIcon } from "lucide-react";
import { LabelPar } from "../ui/pieceLabel";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "../ui/table";
import { PageTitle } from "../page-title";
import Button from "../ui/Button";

export default function CommandeIndexPage () {
    const data = useLoaderData()
    console.log("klgk",data);
    
    return <div className="belongToUser">        
        <h1>commande</h1>
        <Suspense fallback={<UserCardSkeleton/>}>
            <Await resolve={data}>
                <div className="plats-commande-profile">
                    <h1>Plats de la commande</h1>
                    <div className="items">
                        <PageTitle>Commandes</PageTitle>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                <TableHead className="w-10">ID</TableHead>
                                <TableHead>Client</TableHead>
                                <TableHead>Prix</TableHead>
                                <TableHead className="w-10">Status</TableHead>
                                <TableHead className="text-end">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {/* {data.commande.map((item:any) => ( */}
                                <Item item={data.commande} key={data.commande.id} />
                                {/* ))} */}
                            </TableBody>
                        </Table>
                        {/* {  data.plats.map((plat:any) => (
                            <div className="plats-commande-profile-item">
                               <div className="item">
                                    <h3>{plat.name}</h3>
                                    <p className="multiple"><Text children={plat.category.name} limit={13} /><span></span>{plat.price}€</p>
                                    <p className="description"><Text children={plat.description} /></p>
                               </div>
                            </div>
                        ))} */}
                    </div>
                </div>
                <div className="information-livraison">
                    <h1>Informations de livraison</h1>
                    {data.commande.livraisons.map((info:any) => (
                        <div>
                            <LabelPar className="" column='none' label={info.name} par="Nom"/>
                            <LabelPar className="" column='none' label={info.lastname} par="Prenom"/>
                            <LabelPar className="" column='none' label={info.phone} par="téléphone"/>
                            <LabelPar className="" column='none' label={info.instructions} par="instructions"/>
                            <LabelPar className="" column='column' label={info.address} par="address"/>
                            <LabelPar className="" column='column' label={info.email} par="email"/>
                        </div>
                    ))}
                    <p className="supplement-info"><InfoIcon className="info"/>Ces information sont fournient par celui qui à passé la commande, dans le but facilité la tache au livraison lors de la livraison; Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum nam, quasi, vel libero autem cum pariatur atque asperiores quidem, eligendi facilis dignissimos similique amet minus sed doloremque numquam. Numquam, dolorum.</p>
                </div>
            </Await>
        </Suspense>
        
        {/* {avis.map(avi => {
            <p>{ avi.note }</p>
            <p>{ avi.plat.name }</p>
            <p>{ avi.commentaire }</p>
            })   
        } */}
    </div>
}


function Item ({ item }: { item: App.Data.Commande.CommandeData }) {
//   const href = route.edit(item.id)
  return (
    <TableRow className="group">
      <TableCell className="text-muted-foreground">
        {item.id}
    </TableCell>
      <TableCell>
        {item.user.name}
        {item.user.firstname}
        {item.user.email}
      </TableCell>
      <TableCell>
        {item.total_price}
      </TableCell>
      <TableCell>
        {item.status}
      </TableCell>
      <TableCell className="text-right">
        <div className="flex justify-end">
          {/* <ButtonGroup className="opacity-0 group-hover:opacity-100">
            {!item.online && (
              <ButtonLink variant="destructive" href={route.destroy(item.id)}>
                <TrashIcon />
              </ButtonLink>
            )}
          </ButtonGroup>
          <ButtonLink href={href} variant="secondary">
            <EditIcon />
          </ButtonLink> */}
          <Button>
            <EditIcon />
          </Button>
        </div>
      </TableCell>
    </TableRow>
  )
}
