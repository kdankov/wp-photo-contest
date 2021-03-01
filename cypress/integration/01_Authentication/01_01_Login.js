describe('Login', () => {

    it( 'Does not log in without user and pass', () => {

        cy.visit('/');

        cy.get( '#wp-submit' ).click();
        
        cy.get( 'body' ).should('not.have.class', 'archive');

    });

    it( 'Does not login with invalid user and pass', () => {

        cy.visit('/');

        cy.get( 'input#user_login' ).type( 'stuff' );
        cy.get( 'input#user_pass' ).type( 'bad' );
        
        cy.get( '#wp-submit' ).click();
        
        cy.get( 'body' ).should('not.have.class', 'archive');
    });

    it( 'Login with valid user and pass', () => {

        cy.visit('/');

        cy.get( 'input#user_login' ).type( 'testing' );
        cy.get( 'input#user_pass' ).type( 'testing' );

        cy.get( '#wp-submit' ).click();
        
        cy.get( 'body' ).should('not.have.class', 'page-template-login');

    });
    
});