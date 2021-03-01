Cypress.Commands.add("logout", () => {
    cy.get( ".js-logout", { timeout: '200' } ).click(  { force: true } );
    cy.url().should( "include", "/signin" );
});

Cypress.Commands.add("login", (username = 'testing', password = 'testing') => {

    cy.visit('/');

    cy.get( 'input#user_login' ).type( username );
    cy.get( 'input#user_pass' ).type( password );

    cy.get( '#wp-submit' ).click();
    
    cy.get( 'body' ).should('not.have.class', 'page-template-login');

});