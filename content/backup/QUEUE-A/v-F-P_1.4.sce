//HPV STEADY STATE SPEED and POWER FROM FORCE
//johnsnyder@misterchucker.com
//January 09, 2007

// At a constant speed the total Force acting in opposition to linear motion 
// of a cyclist may be known as the sum of the Force due to aerodynamic drag, the
// Force due to rolling resistance and the Force due gravity as influenced by the 
// road slope. This relationship allows solving for a bicyclist's speed (v) and power when 
// F_total and other parameters are specified.
//
// -- EQUATION PROGRESSION --
//[eq 01] F_total = F aero + F roll + F grav
//[eq 02] F_roll = m * g * Crr, 
//[eq 03] F_grav = m * g * sin(slope),
//[eq 04] F_aero = CdA * rho * V_air**2 * 0.5,
//[eq 05] F_total = m*g*(sin(slope) + Crr) + CdA * rho * V_air**2 * 0.5,
//[eq 06] F_total - m*g*(sin(slope) + Crr) = CdA * rho * V_air**2 * 0.5,
//[eq 07] (F_total - m*g*(sin(slope) + Crr))/(CdA * rho * 0.5) = V_air**2,
//[eq 08] sqrt((F_total - m*g*(sin(slope) + Crr))/(CdA * rho * 0.5)) = V_air , and
//[eq 09] V_ground + V_headwind = V_air, thus
//[eq 10] V_ground = sqrt((F_total - m*g*(sin(slope) + Crr))/(CdA * rho * 0.5)) - V_headwind;
//[eq 11] Power = F_total * V_ground

//INPUTS
CdA = .5; //m**2
rho = 1.04; // kg/m**3
F_total = [-15:.1:10]; //newtons
m = 100; // kg
g = 9.81; // m/s**2
slope = -0.02; //radians
Crr = 0.0066; // n/n
V_headwind = 0; // m/s

//SOLUTION GROUND SPEED [eq 10]
V_ground = sqrt((F_total - m*g*(sin(slope) + Crr))/(CdA * rho * 0.5)) - V_headwind;

//SOLUTION POWER [eq 11]
power = diag(F_total' * V_ground);


//GRAPHING
clf()
subplot(121)
plot(V_ground,F_total,'thickness',2)
xlabel('speed, m/s')
ylabel('force, newtons')
title('Force','fontsize',3)
xgrid()
subplot(122)
plot(V_ground,power,'thickness',2)
xlabel('speed, m/s')
ylabel('power, watts')
title('Power','fontsize',3)
xgrid()


// -- END --
