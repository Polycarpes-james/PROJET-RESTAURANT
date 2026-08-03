

export interface Action {
    url: string;
    method: "GET" | "POST" | "PUT" | "PATCH" | "DELETE";
}

export async function request(action:Action, data?:unknown) {

    const options:any = {
        method: action.method,
        headers:{
            "Accept":"application/json",
            "X-CSRF-TOKEN":
                document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content
        }
    };


    if(data instanceof FormData){
        options.body = data;
    }
    else if(data){
        options.headers["Content-Type"] = "application/json";
        options.body = JSON.stringify(data);
    }


    const response = await fetch(
        action.url,
        options
    );


    return response.json();
}