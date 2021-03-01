describe('Contests Archive', () => {
    
    beforeEach(() => {
        cy.login();
    });
    
    it('Does it have more than 1 contest?', () => {
        
        cy.visit('/');

        cy.get( 'body' ).should('have.class', 'post-type-archive-contest');

        cy.get('.contest.type-contest').its('length').should('be.gt', 1);

    });
    
});