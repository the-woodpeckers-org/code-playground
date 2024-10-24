<script>
export default {
    name: "CvBuilder",
    updated() { // Corrected 'onUpdated' to 'updated'
        this.loadScripts(); // Call loadScripts directly in updated lifecycle hook
    },
    mounted() {
        // Add jQuery
        const scriptJquery = document.createElement('script');
        scriptJquery.src = "https://code.jquery.com/jquery-3.6.0.min.js";
        scriptJquery.onload = () => {
            // When jQuery is loaded, load jQuery UI
            this.loadJQueryUI();
        };
        document.body.appendChild(scriptJquery);
    },
    methods: {
        loadJQueryUI() {
            const scriptJQueryUI = document.createElement('script');
            scriptJQueryUI.src = 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
            scriptJQueryUI.onload = () => {
                // When jQuery UI is loaded, call loadScripts to add other scripts
                this.loadScripts();
            };
            document.body.appendChild(scriptJQueryUI);
        },
        loadScripts() {
            // Add script for Anchorme
            const scriptAnchorme = document.createElement('script');
            scriptAnchorme.src = '/js/lib/PageCV/anchorme.min.js';
            document.body.appendChild(scriptAnchorme);

            // Add script for CvEditor
            const scriptCvEditor = document.createElement('script');
            scriptCvEditor.src = '/js/lib/PageCV/CvEditor.js';
            document.body.appendChild(scriptCvEditor);

            // Add script for html2pdf
            const scriptHtml2Pdf = document.createElement('script');
            scriptHtml2Pdf.src = '/js/lib/PageCV/html2pdf.bundle.min.js';
            document.body.appendChild(scriptHtml2Pdf);
        }
    },
};
</script>


  
<style scoped>
:deep body {
    font-family: helvetica, arial, sans-serif;
    font-size: 14px;
    background-color: #ececec;
}

:deep a {
    color: #000;
}

:deep .container {
    width: 100%;
}
:deep .row{
    width: 100%;
}
:deep h1.logo {
    font-weight: 700;
    border: 0.3rem dashed;
    border-radius: 1rem;
    padding: 1rem;
    font-size: 2rem;
    margin-bottom: 0;
}

:deep .section h3 {
    margin: 1rem;
    font-size: 1.6rem;
}

:deep .section h5 {
    font-size: 1rem;
}

:deep .section:not(:last-child)::after {
    content: " ";
    display: block;
    height: 1px;
    border-top: 1px solid #aaa;
    margin-top: 1rem;
}

/* HEADER AND NAVBAR */

:deep .navbar-toggler {
    position: absolute;
    top: 60px;
    right: 20px;
    border: 0;
}

:deep .navbar-nav .nav-item {
    margin-left: auto;
    margin-right: auto;
}

:deep .navbar-nav button.nav-link {
    border: 0;
    background-color: transparent;
    display: inline;
}

:deep .navbar-nav #nav-title {
    color: #fff;
    padding: 0.5rem 0;
    margin: 0 0.5rem;
    font-weight: 700;
    display: inline-block;
    text-transform: uppercase;
}

:deep .custom-header {
    background-color: #606060;
    color: #fff;
    transition: background-color 0.5s;
}

:deep button.nav-link {
    color: #fff;
    padding: 0.5rem 0;
    margin: 0 0.5rem;
}

:deep button.nav-link:hover {
    border-bottom: 1px solid #fff;
}

:deep button.nav-link.active {
    border-bottom: 1px solid #fff;
}

/* PRINTABLE CONTENT STYLING*/

:deep #cv {
    border: solid 1px #aaa;
    padding: 2rem;
    margin-top: 2rem;
    background-color: #fff;
    border-radius: 1rem;
}

:deep #printable h2 {
    margin-top: 2rem;
    margin-bottom: 3rem;
}

:deep #printable .section-heading {
    margin: 0rem 1rem 0.5rem;
}

:deep *[contenteditable="true"]:hover {
    -webkit-animation: blink 1s ease-out infinite;
    -moz-animation: blink 1s ease-out infinite;
    -o-animation: blink 1s ease-out infinite;
    animation: blink 1s ease-out infinite;
    opacity: 0.5;
}

:deep *[contenteditable="true"]:focus {
    outline: thin dashed;
    background-color: #eee;
}

@-webkit-keyframes blink {
    0% {
        opacity: 0.5;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0.5;
    }
}
@-moz-keyframes blink {
    0% {
        opacity: 0.5;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0.5;
    }
}
@-o-keyframes blink {
    0% {
        opacity: 0.5;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0.5;
    }
}

@keyframes blink {
    0% {
        opacity: 0.5;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0.5;
    }
}

/* TABLE STYLES */
:deep .info-label {
    font-weight: bold;
    margin-left: 0.6rem;
}

:deep .info-content {
    margin-right: -0.6rem;
}
:deep .info-name{
    text-align: center;
    font-size: xx-large;
}
/* THREE COLUMN LIST */
:deep .three-column ul {
    margin: 0;
}

/* LISTING ITEMS */
:deep .listing-date-col {
    padding: 0.2rem 0.2rem 0 0.8rem;
}

:deep .listing-location-col,
:deep .listing-content-col {
    padding: 0.2rem 0.2rem;
}

/* ACTION BUTTONS */
:deep .actions {
    padding: 0.5rem 0 2rem;
}

:deep .actions .action-btn {
    margin-top: 0.5rem;
}

:deep .btn-primary {
    background-color: #606060;
    border: 0;
    color: #fff;
    text-transform: uppercase;
    border-radius: 0.3rem;
    border: 0;
}

:deep .btn-primary:hover,
:deep .btn-primary:not(:disabled):not(.disabled):active,
:deep .btn-primary:focus {
    background-color: #aaa;
}

:deep #reset-btn,
:deep #reset-alert-btn {
    background-color: #f08080;
}

:deep #reset-btn:hover,
:deep #reset-alert-btn:hover {
    background-color: #f00;
}

:deep .actions button i {
    padding-left: 0.5rem;
}

:deep .close-modal {
    color: #f00;
}

:deep .close-modal:hover {
    color: #f00;
}

:deep .modal-header,
:deep .modal-footer {
    border: 0;
}

:deep .modal-body {
    font-size: 1.1rem;
}

:deep .modal-content {
    border-radius: 1rem;
}

/* CUSTOM FOOTER */
:deep .custom-footer {
    background-color: #444;
    color: #ececec;
}

/* DELETABLE ITEMS AND DELETE BUTTON */
:deep .section .deletable {
    margin: 0;
}

:deep .deletable,
:deep .add-element,
:deep #add-section {
    position: relative;
    padding: 0.5rem 1rem;
    margin: 0.2rem 0rem;
    border: 1px solid transparent;
    border-radius: 0.5rem;
}
:deep .three-column .deletable,
:deep .three-column .add-element {
    margin: 0.1rem 0.1rem;
    flex: 0 0 32%;
    max-width: 32%;
}

:deep .deletable-hover {
    border: 1px dashed #aaa;
}

:deep .deletebtn {
    padding: 0;
    border: 0;
    border-radius: 50%;
    color: #ffcccb;
    position: absolute;
    right: -0.8rem;
    top: -0.8rem;
    font-size: 1.5rem;
    cursor: pointer;
    z-index: 10;
    width: 1.5rem;
    height: 1.5rem;
    background-color: #fff;
}

:deep .deletebtn:hover {
    color: #f00;
}

:deep .deletebtn i {
    position: absolute;
    top: 0;
    left: 0;
}

/* Adding new item */

:deep .add-element,
:deep #add-section {
    border: 1px dashed #3cb371;
    color: #3cb371;
    cursor: pointer;
}

:deep .add-element:hover,
:deep #add-section:hover {
    border: 1px dashed #2e8b57;
    color: #2e8b57;
}

/* Adding new section */
:deep #add-section {
    background-color: #ececec;
    margin: 1rem 0;
    text-transform: uppercase;
    cursor: auto;
}

:deep #add-section-btn {
    cursor: pointer;
    width: 100%;
    background: transparent;
    border: 0;
    color: #3cb371;
    text-transform: uppercase;
}

:deep #add-section-btn:hover {
    color: #2e8b57;
}

:deep .section-btn {
    color: #000;
    cursor: pointer;
    background: transparent;
    border: 0;
    text-transform: uppercase;
}

:deep .section-btn img:hover {
    transform: scale(1.1);
    -webkit-box-shadow: 0px 6px 5px -1px rgba(0, 0, 0, 0.39);
    -moz-box-shadow: 0px 6px 5px -1px rgba(0, 0, 0, 0.39);
    box-shadow: 0px 6px 5px -1px rgba(0, 0, 0, 0.39);
    transition: transform 0.3s, box-shadow 0.3s, -webkit-box-shadow 0.3s,
        -moz-box-shadow 0.3s;
}

:deep #new-section-buttons img {
    width: 100%;
    margin-bottom: 0.5rem;
}

:deep #close-section {
    position: relative;
    width: 1.5rem;
    height: 1.5rem;
    margin-left: auto;
    color: #ffcccb;
    font-size: 1.5rem;
    cursor: pointer;
    line-height: 0;
    background: transparent;
}

:deep #close-section:hover {
    color: #f00;
}

/* Sortable */

:deep .sortable {
    background-color: #fff;
}

:deep .sortable-btn {
    color: #aaa;
    position: absolute;
    left: 5px;
    top: 5px;
    cursor: grab !important;
    font-size: 1.2rem;
    border: 0;
    padding: 0;
    background: transparent;
}

:deep .sortable-btn:hover {
    color: #606060;
}

:deep .three-column .sort-placeholder {
    flex: 0 0 32%;
    max-width: 32%;
}

:deep .sort-placeholder {
    height: 2.4rem;
    background-color: #eee;
    border: 1px dashed #aaa;
    border-radius: 0.5rem;
    margin: 0;
}

:deep .ui-sortable-helper {
    -webkit-box-shadow: 0px 6px 5px -1px rgba(0, 0, 0, 0.39);
    -moz-box-shadow: 0px 6px 5px -1px rgba(0, 0, 0, 0.39);
    box-shadow: 0px 6px 5px -1px rgba(0, 0, 0, 0.39);
}

/* Save Alert */
:deep .alert {
    margin: 1rem 0 0;
    border-radius: 1rem;
}

:deep .close-alert {
    color: #f08080;
    text-shadow: none;
}

:deep .close-alert:hover {
    color: #f00;
}

/* Media Queries */

@media only screen and (max-width: 992px) {
    :deep h1.logo {
        font-size: 1.3rem;
    }

    :deep .navbar-toggler {
        position: absolute;
        top: 1rem;
        right: 0.2rem;
        border: 0;
    }

    :deep #cv {
        padding: 0.1rem;
    }
    :deep .main-container {
        width: 100% !important;
    }

    :deep .deletable {
        padding: 0.5rem 1.5rem;
        margin: 0.2rem 0.5rem;
    }

    :deep .listing-date-col {
        padding: 0.2rem 0.2rem 0;
    }

    :deep .info-label {
        padding-left: 0;
    }

    :deep .info-content {
        padding-left: 0;
        margin-left: 0.6rem;
    }

    :deep .three-column .sort-placeholder {
        flex: 0 0 49%;
        max-width: 100%;
    }

    :deep .three-column .deletable,
    :deep .three-column .add-element {
        margin: 0.1rem;
        flex: 0 0 49%;
        max-width: 49%;
    }
}

@media only screen and (max-width: 576px) {
    :deep .three-column .sort-placeholder {
        flex: auto;
        max-width: 100%;
    }

    :deep .three-column .deletable,
    :deep .three-column .add-element {
        margin: 0.1rem;
        flex: 0 0 100%;
        max-width: 100%;
    }
}
/* Importing fonts from google fonts */
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,600|Open+Sans:400,700|Raleway:400|Roboto:400,700|Lato:400,700|Jost:400,500");

/* Moden Theme */
:deep .theme-modern h2,
:deep .theme-modern h3,
:deep .theme-modern h5 {
    color: #1e3f5a;
    font-family: "Montserrat", sans-serif;
    font-weight: 600;
}

:deep .theme-modern {
    color: #454545;
    font-family: "Open Sans", sans-serif;
}

:deep .theme-modern .section:not(:last-child)::after {
    border-top: 1px solid #1e3f5a;
    margin: 1rem 8rem 0;
}

:deep .theme-modern .three-column ul {
    list-style-type: square;
}

:deep .theme-modern a {
    color: #1e3f5a;
}

:deep .custom-header .theme-modern {
    background-color: #1e3f5a;
    color: #fff;
    font-family: helvetica, arial, sans-serif;
}

/* Lavender Theme */
:deep .theme-lavender h2,
:deep .theme-lavender h3,
:deep .theme-lavender h5 {
    color: #595775;
    font-family: "Raleway", sans-serif;
    font-weight: 400;
}

:deep .theme-lavender {
    color: #555;
    font-family: "Roboto", sans-serif;
}

:deep .theme-lavender .three-column ul {
    list-style-type: circle;
}

:deep .theme-lavender .section:not(:last-child)::after {
    border-top: 1px solid #8a87b0;
    margin: 1rem 12rem 0;
}

:deep .theme-lavender a {
    color: #595775;
}

:deep .custom-header .theme-lavender {
    background-color: #595775;
    color: #fff;
    font-family: helvetica, arial, sans-serif;
}

/* Deco Theme */
:deep .theme-deco h2,
:deep .theme-deco h3,
:deep .theme-deco h5 {
    color: #132226;
    font-family: "Jost", sans-serif;
    font-weight: 500;
}

:deep .theme-deco {
    color: #132226;
    font-family: "Lato", sans-serif;
}

:deep .theme-deco .three-column ul {
    list-style-type: none;
}

:deep .theme-deco a {
    color: #132226;
}

:deep .custom-header .theme-deco {
    background-color: #132226;
    color: #fff;
    font-family: helvetica, arial, sans-serif;
}

</style>
  
<template>
    <div>
      <!-- HEADER -->
      <header class="custom-header">
        <nav class="navbar navbar-expand-lg static-top navbar-dark">
          <div class="container">
            <h1 class="logo">cv builder</h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
              aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- NAVIGATION -->
            <div class="collapse navbar-collapse mt-md-3" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <span id="nav-title">Themes:</span>
                </li>
                <li class="nav-item">
                  <button class="nav-link active pl-0 pr-0" id="theme-default-link"
                    aria-label="Switch to default theme"> Default <span class="sr-only">(current)</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link pl-0 pr-0" id="theme-modern-link" aria-label="Switch to modern theme">
                    Modern
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link pl-0 pr-0" id="theme-lavender-link" aria-label="Switch to lavender theme">
                    Lavender
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link pl-0 pr-0" id="theme-deco-link" aria-label="Switch to deco theme">
                    Deco
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
  
      <div class="container main-container">
        <div id="cv">
          <!-- PRINTABLE HTML -->
          <div id="printable" class="ml-auto mr-auto sortable-list"></div>
        
          <!-- New Section Buttons -->
          <div id="add-section">
            <button id="add-section-btn" class="text-center" aria-label="Add new section">
              <i class="fas fa-plus-circle"></i> New Section
            </button>
            <div id="close-section" class="text-right">
              <i class="fas fa-times-circle"></i>
            </div>
            <div class="flex flex-grow w-full text-center hide gap-4" id="new-section-buttons">
                    <button class="section-btn pb-4 pb-md-0" id="newinfo-btn"
                        aria-label="Add new info section">
                        <img src="images\new-section-info.png" alt="Add new info section" />
                        Info
                    </button>
                    <button class="section-btn pb-4 pb-md-0" id="newlisting-btn"
                        aria-label="Add new listing section">
                        <img src="images\new-section-listing.png" alt="Add new listing section" />
                        Listing
                    </button>
                    <button class="section-btn pb-4 pb-md-0" id="new3col-btn"
                        aria-label="Add new three column section">
                        <img src="images\new-section-3-col.png" alt="Add new three column section" />
                        Three Columns
                    </button>
                    <button class="section-btn" id="newsingleblock-btn" aria-label="Add new block section">
                        <img src="images\new-section-block.png" alt="Add new block section" />
                        Block
                    </button>
                </div>
            <!-- Add more sections if needed -->
          </div>
        </div>
      </div>
  
      <div class="container">
        <!-- Succesful save alert -->
        <div id="save-alert" class="alert alert-success alert-dismissible fade show text-center" role="alert">
          <strong>CV saved successfully!</strong>
          <p>
            Your CV has been saved locally.
            <br />
            Be aware that clearing your browser's cache will result in
            the loss of your saved information.
          </p>
          <button type="button" class="close" aria-label="Close alert">
            <span aria-hidden="true" class="close-alert">
              <i class="fas fa-times-circle"></i>
            </span>
          </button>
        </div>
  
        <!-- Action Buttons -->
        <div class=" actions text-center">
          <button class="btn btn-primary action-btn" id="reset-alert-btn" aria-label="Reset CV">
            RESET
            <i class="fas fa-undo-alt"></i>
          </button>
          <button class="btn btn-primary action-btn" id="save-btn" aria-label="Save Cv">
            SAVE
            <i class="far fa-save"></i>
          </button>
          <button class="btn btn-primary action-btn" id="download-btn" aria-label="Download as pdf">
            DOWNLOAD AS PDF
            <i class="fas fa-file-download"></i>
          </button>
        </div>
      </div>
  
      <!-- Modal Window to reset content to default-->
      <div class="modal" id="reset-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Are you sure?</h4>
              <button type="button" class="close close-modal" aria-label="Close">
                <span aria-hidden="true">
                  <i class="fas fa-times-circle"></i>
                </span>
              </button>
            </div>
            <div class="modal-body">
              <p>
                By resetting the content, you will lose all your
                changes.
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="reset-btn" aria-label="reset">
                Reset
                <i class="fas fa-undo-alt"></i>
              </button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="cancel">
                Cancel
              </button>
            </div>
          </div>
        </div>
      </div>
  
      <footer class="container-fluid custom-footer">
        <div class="container text-right">
          CV Builder by The Woodpeckers 2024
        </div>
      </footer>
    </div>
  </template>
  
 