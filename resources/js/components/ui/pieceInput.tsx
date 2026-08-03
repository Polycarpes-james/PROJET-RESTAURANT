import { ReactNode } from "react"
import { Input } from "./input"
import { Label } from "./label"

interface Props {
    name:string,
    type:string,
    user?: string|undefined,
    className: string,
    children:ReactNode
}

function InputLabel ({name, user, type, className, children }: Props) {
    return <div className={className === "" ? "item-input" : className}>
            <Label htmlFor={name}>{children}</Label>
            <Input type={type} className="item-input-field" name={name} defaultValue={user}/>
        </div>
}

export {InputLabel}