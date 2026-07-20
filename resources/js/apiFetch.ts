/**
 * Cette fonction gere le fetch
 * @param url L'url à envoyé
 * @param options Toutes les options
 * @returns 
 */
export async function apiFetch(url: string, method: string, options: Record<string,any> = {}) {
    const config: RequestInit = {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': (
                document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
            ).content,
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    };

    if (method !== 'GET' && method !== 'HEAD') {
        config.body = JSON.stringify(options);
    }

    const response = await fetch(url, config);

    const data = await response.json();


    if (!response.ok) throw data;

    return { data, response };
}