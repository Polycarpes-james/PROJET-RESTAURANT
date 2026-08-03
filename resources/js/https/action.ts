// http/Action.ts

export class Action {

    constructor(
        public url: string,
        public method: "GET" | "POST" | "PUT" | "PATCH" | "DELETE"
    ) {}

}