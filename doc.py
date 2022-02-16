# coding: utf8

target = "Sym-CRM.md"

def compile(fList):
    res = ""

    # Lecture

    for el in fList:
        fileName = "document/" + el + ".md"

        with open(fileName, "r") as file:
            res += file.read() + "\n"
        
            file.close()

    # Ecriture

    with open(f"document/{target}", "w") as file:
        file.write(res)
        file.close()

    print(f"Le fichier {target} a été compilé.")

# Dossier de synthèse

report = ["Intro", "N1-Normes", "N2-Composants"]
report += ["parts/N3.1-Pages", "parts/N3.2-Utilisateurs", "parts/N3.3-Equipes", "parts/N3.4-Evenements", "parts/N3.5-Contacts"]
report += ["N4-Conception"]

compile(report)