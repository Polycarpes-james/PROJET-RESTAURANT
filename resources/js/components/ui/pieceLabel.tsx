import type * as React from "react"
import { cn } from "@/lib/utils";
import { Label } from "./label";

interface Props {
    className:string | undefined,
    column:string | undefined,
    label:string | null,
    par:string
}

function LabelPar ({className = "", column, par, label}: Props) {
    return <div className={cn("item-label-par", className, column === "column" ? "column" : null)}>
        <p className="p">{par}</p>
        <Label className="strong">{label}</Label>
    </div>
}

export {LabelPar}