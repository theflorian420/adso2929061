// Define enemy types with enums
enum EnemyType {
    Flying,
    Ground,
    Boss
}

const currentEnemy = EnemyType.Boss;

const output06 = document.getElementById('output06');
if (output06) {
    output06.innerHTML = `
    <li></li><b>Enemy Type:</b> ${EnemyType[currentEnemy]}</li>
    <li></li><b>Type Value:</b> ${currentEnemy}</li>
    `;
}