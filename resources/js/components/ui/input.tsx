

function Input ({ className, type, ...props }: React.ComponentProps<"input"> & { onValueChange?: (s: string) => void }) {
  return (
        <div className="search-wrap">
            <input type={type} data-slot="input" className={className} {...props} />
        </div>
    )
}

export { Input }
