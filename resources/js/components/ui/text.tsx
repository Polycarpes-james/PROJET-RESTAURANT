type TextProps = {
    children: React.ReactNode;
    limit?: number;
};

export default function Text({
    children,
    limit = 40,
}: TextProps) {

    const text = String(children);

    if (text.length <= limit) {
        return <>{text}</>;
    }

    return <>{text.substring(0, limit)}...</>;
}
