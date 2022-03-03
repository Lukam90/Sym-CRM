class SearchFormElement extends HTMLElement {
    connectedCallback() {
        const table = this.getAttribute("table");
        const placeholder = this.getAttribute("placeholder");

        this.innerHTML = `
            <style>
            .block {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            </style>

            <div class="block">
                <form action="/${table}/search" id="searchForm">
                    <div class="field">
                        <input type="search" name="filter" class="input width-25" placeholder="Ex: ${placeholder}" />
            
                        <button type="submit" class="button is-link ml-10">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
            
                        <button class="button is-success ml-10" onclick="resetPage();">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        `;
    }
}

customElements.define("search-form", SearchFormElement);