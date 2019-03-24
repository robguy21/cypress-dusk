describe("Category Tests", function() {
    it("Adds a category", function() {
        cy.visit("localhost:8000");
        cy.get('[data-test-id="button-add_category"').click();
        cy.get('[data-test-id="component-dialog"]').within(() => {
            cy.get('input[name="new_category"]').type("TestCategory");
            cy.get('[data-test-id="button-save_dialog"]').click();
        });
        cy.get('[data-test-id="component-dialog"]').should("not.exist");
        cy.get('[data-test-id="component-app_bar"]').contains("TestCategory");
    });

    it("Adds an item to a new ategory", function() {
        cy.visit("localhost:8000");
        cy.get('[data-test-id="button-add_category"').click();
        cy.get('[data-test-id="component-dialog"]').within(() => {
            cy.get('input[name="new_category"]').type("TestCategory");
            cy.get('[data-test-id="button-save_dialog"]').click();
        });
        cy.get('[data-test-id="component-dialog"]').should("not.exist");
        cy.get('[data-test-id="component-app_bar"]')
            .contains("TestCategory")
            .click();
        cy.get('[data-test-id="input-add_item"] input').type("Hello World!");
        cy.get('[data-test-id="button-add_item"]').click();
        cy.get('[data-test-id="component-tab_container"]').contains(
            "Hello World!"
        );
    });
});
