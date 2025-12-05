// Enemi class
class Enemy {
    // attributes
    name: string;
    health: number;


    constructor(name: string, health: number) {
        this.name = name;
        this.health = health;
    }

    takeDamage(damage: number): void {
        this.health -= damage;
    }
}

const mosskin = new Enemy('Mosskin', 100);
mosskin.takeDamage(15);
mosskin.takeDamage(15);
mosskin.takeDamage(15);

const output04 = document.getElementById('output04')

if (output04) {
    output04.innerHTML = `
    <li><b>Enemy Name:</b> ${mosskin.name}</li>
    <li><b>Total Health after 3 attacks:</b> ${mosskin.health}</li>
    `;
}