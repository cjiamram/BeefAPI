from fractions import*
import sys
import json
fat=sys.argv[1];
beef=sys.argv[2];
numerator = fat
denominator = beef
fraction = str(Fraction(int(numerator),int(denominator)))
jsonObj= json.dumps({"frac":fraction})
print (jsonObj)