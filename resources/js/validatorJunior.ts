const formulaire_plats = document.querySelector('.formulaire-create-plats')
const element_target = document.querySelector('.add-input textarea')

/**
 * 
 * @param {String} tagname 
 * @param {Object} contents 
 * @returns 
 */
function createNewElement(tagname:any, contents = {}){
    const newElement = document.createElement(tagname)
    for (const [key, value] of Object.entries(contents)) {
        newElement.setAttribute(key, value)
    }
    return newElement
}
/**
 * 
 * @param {HTMLTextAreaElement} element 
 */
function showError (element:any) {
    clearError(element)
    const error_content = createNewElement('p', {'class':'error'})
    error_content.textContent = 'Vous devez remplir le champ !'
    element.parentElement.parentElement.appendChild(error_content)
}

/**
 * 
 * @param {HTMLTextAreaElement} element 
 */
function clearError (element:any) {
    const parent = element.parentElement.parentElement;
    
    const existingError = parent.querySelector(".error");
    if (existingError) {
      existingError.remove();
    }
    // field.style.border = "";
}

function validatedForm (){
    let isValid = true
    const field = element_target

    const valid = validField(field)

    if (!valid) {
        isValid = false
    }
    
    return isValid;
}
/**
 * 
 * @param {HTMLTextAreaElement} field 
 */
function validField (field:any){
    if(field.value.trim() === ""){
        showError(field)
        return false
    }

    return true
}
/**
 * 
 * @param {HTMLTextAreaElement} element 
 * @param {HTMLFormElement} formulaire 
 */
function validator (element:any, formulaire:any){
    if(!formulaire) return ;
    
    formulaire.addEventListener('submit', (e:any)=>{
        if (element.parentElement.parentElement.classList.contains('hidden-content')) {
            return
        } else {
            if(validatedForm()){
                return
            } 
            e.preventDefault()
        }
    })
}

// document.addEventListener('DOMContentLoaded', ()=>{
validator(element_target, formulaire_plats)
// })