<script>
    /**
     * Add JS to:
     * - [x] show inner form on click of button
     * - handle submission of inner form
     * - after submission, replace inner-form with response of HandleSupportFormSubmissionController
     */

    function bootstrapSupportForm(element) {
        const container = element.querySelector('.spatie-support-form__container');
        const formContainer = element.querySelector('.spatie-support-form__form');
        const responseContainer = element.querySelector('.spatie-support-form__response');

        element.querySelector('.spatie-support-form__button button')
            .addEventListener('click', () => {
                responseContainer.style.display = 'none';
                formContainer.style.display = 'flex';
                container.style.display = container.style.display === 'flex' ? 'none' : 'flex';
            });

        element.querySelector('.spatie-support-form__form form')
            .addEventListener('submit', (event) => {
                event.preventDefault();
                const formData = new FormData(event.target)
                const formProps = Object.fromEntries(formData);

                fetch(event.target.action, {
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(formProps),
                    method: "post"
                })
                    .then(response => response.text())
                    .then(html => {
                        responseContainer.innerHTML = html;
                        responseContainer.style.display = 'flex';
                        formContainer.style.display = 'none';
                    });
            });
    }

    document
        .querySelectorAll('.spatie-support-form')
        .forEach(form => bootstrapSupportForm(form));
</script>