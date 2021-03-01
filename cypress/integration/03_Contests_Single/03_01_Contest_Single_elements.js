describe('Contests Archive', () => {
    
    beforeEach(() => {
        cy.login();
    });
    
    it('Is the first contents closed?', () => {
        
        cy.visit('/');

        cy.get( 'body' ).should('have.class', 'post-type-archive-contest');

        cy.get('.contest.type-contest:eq(-1) a').click();

        cy.get('.entry-header h3').contains('Photography Contest');
        cy.get('.entry-header h1').contains('Closed');

    });
    
});