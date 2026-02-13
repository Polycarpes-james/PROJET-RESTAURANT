type Rule = "required" | "email" | `min:${number}` | `max:${number}`;

interface ValidatorRules {
  [field: string]: Rule[];
}

interface ValidatorMessages {
  [field: string]: {
    [rule: string]: string;
  };
}

class Validator {
  private form: HTMLFormElement;
  private rules: ValidatorRules;
  private messages: ValidatorMessages;

  constructor(form: HTMLFormElement, rules: ValidatorRules, messages: ValidatorMessages) {
    this.form = form;
    this.rules = rules;
    this.messages = messages;
    this.init();
  }

  private init() {
    const allFields = this.form.querySelectorAll<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>(
      "input, textarea, select"
    );

    allFields.forEach((field) => {
      field.addEventListener("input", () => this.validateField(field));
      field.addEventListener("focus", () => this.clearError(field));
    });

    this.form.addEventListener("submit", (e) => {
        // if(validatedForm()){
        //         return
        // } 
        e.preventDefault()
    });
  }

  private showError(field: HTMLElement, message: string) {
    this.clearError(field);
    const error = document.createElement("p");
    error.className = "error";
    error.style.color = "red";
    error.textContent = message;
    field.style.border = "1px solid red";
    field.parentElement?.appendChild(error);
  }

  private clearError(field: HTMLElement) {
    const existingError = field.parentElement?.querySelector(".error");
    if (existingError) existingError.remove();
    field.style.border = "";
  }

  private validateField(field: HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement): boolean {
    const fieldRules = this.rules[field.name] || [];

    for (let rule of fieldRules) {
      // --- RADIO / CHECKBOX ---
      if (field instanceof HTMLInputElement && (field.type === "radio" || field.type === "checkbox")) {
        const group = this.form.querySelectorAll<HTMLInputElement>(`input[name="${field.name}"]`);
        const isChecked = Array.from(group).some((input) => input.checked);
        const referenceField = group[0];

        if (!isChecked) {
          this.showError(referenceField, this.messages[field.name]?.required || "Vous devez faire un choix");
          return false;
        } else {
          this.clearError(referenceField);
        }
        continue;
      }

      // --- REQUIRED ---
      if (rule === "required") {
        if (!field.value || field.value.trim() === " " || (field instanceof HTMLSelectElement && field.value === "")) {
          this.showError(field, this.messages[field.name]?.required || "Ce champ est obligatoire");
          return false;
        }
      }

      // --- EMAIL ---
      if (rule === "email") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (field.value.trim() && !emailRegex.test(field.value)) {
          this.showError(field, this.messages[field.name]?.email || "Email invalide");
          return false;
        }
      }

      // --- MIN LENGTH ---
      if (rule.startsWith("min:")) {
        const min = parseInt(rule.split(":")[1]);
        if (field.value.trim().length < min) {
          this.showError(field, this.messages[field.name]?.min || `Minimum ${min} caractères`);
          return false;
        }
      }

      // --- MAX LENGTH ---
      if (rule.startsWith("max:")) {
        const max = parseInt(rule.split(":")[1]);
        if (field.value.trim().length > max) {
          this.showError(field, this.messages[field.name]?.max || `Maximum ${max} caractères`);
          return false;
        }
      }
    }

    // Tout est valide → bordure verte
    field.style.border = "1px solid green";
    this.clearError(field); // supprime message s'il existe
    return true;
  }

  public validateForm(): boolean {
    let isValid = true;
    const fields = this.form.querySelectorAll<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>(
      "input, textarea, select"
    );

    fields.forEach((field) => {
      const valid = this.validateField(field);
      if (!valid) isValid = false;
    });

    return isValid;
  }
}


document.addEventListener("turbo:load", () => {
  const clientForm = document.getElementById("information-client-form") as HTMLFormElement;
  if (clientForm) {
    new Validator(
      clientForm,
      {
        name: ["required", "min:3", "max:20"],
        lastname: ["required", "min:3", "max:20"],
        email: ["required", "email"],
        address: ["required", "min:5"],
        instructions: ["required", "min:10"],
        phone: ["required", "min:6"],
      },
      {
        name: {
          required: "Vous devez remplir votre nom !",
          min: "Le nom doit contenir au moins 3 caractères",
          max: "Le nom ne peut pas dépasser 20 caractères",
        },
        lastname: {
          required: "Vous devez remplir votre prénom !",
          min: "Le prénom doit contenir au moins 3 caractères",
          max: "Le prénom ne peut pas dépasser 20 caractères",
        },
        email: {
          required: "Vous devez remplir votre email !",
          email: "L'adresse email n'est pas valide",
        },
        address: {
          required: "Vous devez remplir votre adresse !",
          min: "L'adresse est trop courte !",
        },
        instructions: {
          required: "Vous devez remplir les instructions !",
          min: "Les instructions sont trop courtes !",
        },
        phone: {
          required: "Vous devez remplir votre numéro de téléphone !",
          min: "Votre numéro est trop court !",
        }      
      }
    );
  }
});
