import Skeleton from "./skeleton";

export default function UserCardSkeleton() {
    return (
        <div className="carde">
            <div className="part-first">
                <Skeleton width={500} height={100} />
                <Skeleton width={500} height={100} />
            </div>
            <div className="part-txo">
                <Skeleton width={500} height={100} />
                <Skeleton width={500} height={100} />
            </div>
            <Skeleton width={1100} height={80} />
        </div>
    );
}