type SkeletonProps = {
    width?: number | string;
    height?: number | string;
    className?: string;
};

export default function Skeleton({
    width = "100%",
    height = 20,
    className = "",
}: SkeletonProps) {
    return (
        <div
            className={`skeleton ${className}`}
            style={{
                width,
                height,
            }}
        />
    );
}