import { PolymerElement, html } from 'https://unpkg.com/@polymer/polymer@3.0.0-pre.13/polymer-element.js';
// Define the class for a new element called custom-element
class LessonParagraph extends PolymerElement {
  static get properties() {
    return {
      model: { type: Object, notify: true },
      current: { type: Object },
      currentIndex: {type: Number, value: 0}
    };
  }

  currentLesson(object) {
    return this.current[object]
  }

  nextLesson(){
    this.set('current', this.model[this.currentIndex++]);
  }

  static get template() {
    return html`
      {{currentLesson('content')}} {{currentIndex}} {{current.content}}
      <div>
        <div class="s">
          <div>
            <div class="d-flex align-items-center flex-column bd-highlight mb-3" style="height: 72vh;">
              <div class="mt-auto">
                <button class="btn btn-warning" on-click="nextLesson">Lanjutkan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
  }
}
// Register the new element with the browser
customElements.define('lesson-paragraph', LessonParagraph);
