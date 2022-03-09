# coding: utf8

target = "Sym-CRM.md"

def compile(fList):
    res = ""

    # Lecture

    for el in fList:
        fileName = "document/" + el + ".md"

        with open(fileName, "r") as file:
            res += file.read() + "\n" * 2
        
            file.close()

    # Ecriture

    with open(f"document/{target}", "w") as file:
        file.write(res)
        file.close()

    print(f"Le fichier {target} a été compilé.")

# Dossier de synthèse

report = ["intro", "1-normes", "2-composants"]
report += ["parts/3.1-pages", "parts/3.2-utilisateurs", "parts/3.3-equipes", "parts/3.4-evenements", "parts/3.5-contacts"]
report += ["4-conception"]

compile(report)